<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

echo "Migrating old assets to Laravel Storage...\n";

// Map table -> column -> folder -> old_prefix
$migrations = [
    ['table' => 'achievements', 'column' => 'image', 'folder' => 'achievements', 'prefix' => 'assets/img/achievements/'],
    ['table' => 'certifications', 'column' => 'image', 'folder' => 'certifications', 'prefix' => 'assets/img/certifications/'],
    ['table' => 'gallery', 'column' => 'image', 'folder' => 'gallery', 'prefix' => 'assets/img/gallery/'],
    ['table' => 'portfolios', 'column' => 'image', 'folder' => 'portfolio', 'prefix' => 'assets/img/portfolio/'],
    ['table' => 'music_tracks', 'column' => 'audio_file', 'folder' => 'audio', 'prefix' => 'assets/audio/'],
    ['table' => 'music_tracks', 'column' => 'cover_image', 'folder' => 'images', 'prefix' => 'assets/img/'],
];

foreach ($migrations as $m) {
    $table = $m['table'];
    $column = $m['column'];
    $folder = $m['folder'];
    $prefix = $m['prefix'];
    
    $records = DB::table($table)->where($column, 'LIKE', 'assets/%')->get();
    foreach ($records as $record) {
        $oldPath = $record->$column; // e.g. assets/img/achievements/foo.jpg
        $filename = basename($oldPath);
        $newPath = $folder . '/' . $filename; // e.g. achievements/foo.jpg
        
        // Copy file
        if (file_exists(public_path($oldPath))) {
            if (!Storage::disk('public')->exists($folder)) {
                Storage::disk('public')->makeDirectory($folder);
            }
            if (!Storage::disk('public')->exists($newPath)) {
                File::copy(public_path($oldPath), storage_path('app/public/' . $newPath));
                echo "Copied $oldPath to storage/app/public/$newPath\n";
            }
        }
        
        // Update DB
        DB::table($table)->where('id', $record->id)->update([$column => $newPath]);
        echo "Updated DB record $table id {$record->id} to $newPath\n";
    }
}

// Settings
$setting = DB::table('site_settings')->first();
if ($setting && isset($setting->profile_image) && str_starts_with($setting->profile_image, 'assets/')) {
    $oldPath = $setting->profile_image;
    $filename = basename($oldPath);
    $newPath = 'images/' . $filename;
    if (file_exists(public_path($oldPath))) {
        if (!Storage::disk('public')->exists('images')) {
            Storage::disk('public')->makeDirectory('images');
        }
        if (!Storage::disk('public')->exists($newPath)) {
            File::copy(public_path($oldPath), storage_path('app/public/' . $newPath));
        }
    }
    DB::table('site_settings')->where('id', $setting->id)->update(['profile_image' => $newPath]);
    echo "Updated settings profile_image to $newPath\n";
}

// Run artisan storage:link
echo shell_exec('php artisan storage:link');

echo "Migration complete.\n";
