<?php

$controllers = glob(__DIR__ . '/app/Http/Controllers/Admin/*.php');

foreach ($controllers as $file) {
    $content = file_get_contents($file);
    
    // Check if we need to add Illuminate\Support\Facades\Storage
    if (strpos($content, 'move(public_path') !== false && strpos($content, 'use Illuminate\Support\Facades\Storage;') === false) {
        $content = preg_replace('/(use Illuminate\\\\Http\\\\Request;)/', "$1\nuse Illuminate\\Support\\Facades\\Storage;", $content);
    }
    
    // Refactor Achievement/Certification/Gallery/Portfolio store/update
    // from: $data['image'] = 'assets/img/achievements/' . $request->file('image')->getClientOriginalName();
    //       $request->file('image')->move(public_path('assets/img/achievements'), $request->file('image')->getClientOriginalName());
    // to:   $data['image'] = $request->file('image')->storeAs('achievements', $request->file('image')->getClientOriginalName(), 'public');
    
    $content = preg_replace_callback('/\$data\[\'(.*?)\'\] = \'assets\/(.*?)\/\' \. \$request->file\(\'(.*?)\'\)->getClientOriginalName\(\);\s*\$request->file\(\'.*?\'\)->move\(public_path\(\'.*?\'\), \$request->file\(\'.*?\'\)->getClientOriginalName\(\)\);/s', function($matches) {
        $field = $matches[1];
        $folder = str_replace('img/', '', $matches[2]);
        if ($folder === 'img') $folder = 'images'; // For settings
        return "\$data['$field'] = \$request->file('$field')->storeAs('$folder', \$request->file('$field')->getClientOriginalName(), 'public');";
    }, $content);
    
    // MusicTrackController is a bit complex
    if (strpos($file, 'MusicTrackController') !== false) {
        // refactor audio
        $content = preg_replace_callback('/\$request->file\(\'(.*?)\'\)->move\(public_path\(\'assets\/(.*?)\'\), \$fileName\);/s', function($matches) {
            $field = $matches[1];
            $folder = str_replace('img', 'images', $matches[2]); // assets/audio -> audio, assets/img -> images
            return "\$request->file('$field')->storeAs('$folder', \$fileName, 'public');";
        }, $content);
        
        // refactor unlink
        $content = preg_replace_callback('/if \(\$music->(.*?) && file_exists\(public_path\(\$music->.*?\)\)\) \{\s*unlink\(public_path\(\$music->.*?\)\);\s*\}/s', function($matches) {
            $field = $matches[1];
            return "if (\$music->$field && Storage::disk('public')->exists(\$music->$field)) {\n                Storage::disk('public')->delete(\$music->$field);\n            }";
        }, $content);
        
        // audio path assignments: $data['audio_file'] = 'assets/audio/' . $fileName; -> $data['audio_file'] = 'audio/' . $fileName;
        $content = preg_replace('/\$data\[\'(.*?)\'\] = \'assets\/audio\/\' \. \$fileName;/', "\$data['$1'] = 'audio/' . \$fileName;", $content);
        $content = preg_replace('/\$data\[\'(.*?)\'\] = \'assets\/img\/\' \. \$fileName;/', "\$data['$1'] = 'images/' . \$fileName;", $content);
    }
    
    // SettingController
    if (strpos($file, 'SettingController') !== false) {
        // $settings['profile_image'] = 'assets/img/' . $fileName;
        $content = preg_replace('/\$settings\[\'(.*?)\'\] = \'assets\/img\/\' \. \$fileName;/', "\$settings['$1'] = 'images/' . \$fileName;", $content);
        $content = preg_replace('/\$request->file\(\'(.*?)\'\)->move\(public_path\(\'assets\/img\'\), \$fileName\);/', "\$request->file('$1')->storeAs('images', \$fileName, 'public');", $content);
        
        // unlink for setting
        $content = preg_replace('/if \(\$oldImage && file_exists\(public_path\(\$oldImage\)\)\) \{\s*unlink\(public_path\(\$oldImage\)\);\s*\}/', "if (\$oldImage && Storage::disk('public')->exists(\$oldImage)) {\n                Storage::disk('public')->delete(\$oldImage);\n            }", $content);
    }
    
    // General destroy unlink
    $content = preg_replace_callback('/if \(\$(.*?)->(.*?) && file_exists\(public_path\(\$.*?->.*?\)\)\) \{\s*unlink\(public_path\(\$.*?->.*?\)\);\s*\}/s', function($matches) {
        $var = $matches[1];
        $field = $matches[2];
        return "if (\$$var->$field && Storage::disk('public')->exists(\$$var->$field)) {\n            Storage::disk('public')->delete(\$$var->$field);\n        }";
    }, $content);

    file_put_contents($file, $content);
}
echo "Controllers Refactored\n";
