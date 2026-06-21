<?php
$viewsDir = __DIR__ . '/resources/views';
$legacyDir = __DIR__ . '/legacy_backup';

if (!is_dir($viewsDir . '/partials')) {
    mkdir($viewsDir . '/partials', 0777, true);
}

// 1. Copy index.php
file_put_contents($viewsDir . '/home.blade.php', file_get_contents($legacyDir . '/index.php'));

// 2. Copy partials
$partials = glob($legacyDir . '/partials/*.php');
foreach ($partials as $p) {
    $name = basename($p, '.php');
    file_put_contents($viewsDir . '/partials/' . $name . '.blade.php', file_get_contents($p));
}

// 3. Process all blade files
$bladeFiles = array_merge(
    glob($viewsDir . '/*.blade.php'),
    glob($viewsDir . '/partials/*.blade.php')
);

foreach ($bladeFiles as $file) {
    $content = file_get_contents($file);

    // Remove bootstrap
    $content = preg_replace('/<\?php\s+require_once\s+__DIR__ \. \'\/includes\/bootstrap\.php\';\s*\?>/s', '', $content);
    $content = preg_replace('/<\?php \$siteSettings = getSiteSettings\(\); \?>/s', '', $content);
    
    // Convert print e to blade
    $content = preg_replace('/<\?=\s*e\(\s*\(string\)\s*(.*?)\s*\)\s*\?>/s', '{{ $1 }}', $content);
    $content = preg_replace('/<\?=\s*e\(\s*(.*?)\s*\)\s*\?>/s', '{{ $1 }}', $content);
    
    // Convert print string to blade unescaped
    $content = preg_replace('/<\?=\s*\(string\)\s*(.*?)\s*\?>/s', '{!! $1 !!}', $content);
    $content = preg_replace('/<\?=\s*(.*?)\s*\?>/s', '{!! $1 !!}', $content);

    // Convert foreach
    $content = preg_replace('/<\?php\s+foreach\s*\((.*?)\s+as\s+(.*?)\):\s*\?>/s', '@foreach ($1 as $2)', $content);
    $content = preg_replace('/<\?php\s+endforeach;\s*\?>/s', '@endforeach', $content);

    // Convert if / else / endif
    $content = preg_replace('/<\?php\s+if\s*\((.*?)\):\s*\?>/s', '@if ($1)', $content);
    $content = preg_replace('/<\?php\s+else:\s*\?>/s', '@else', $content);
    $content = preg_replace('/<\?php\s+endif;\s*\?>/s', '@endif', $content);
    
    // Convert require partials
    $content = preg_replace('/<\?php\s+require\s+__DIR__\s*\.\s*\'\/partials\/(.*?)\.php\';\s*\?>/s', '@include(\'partials.$1\')', $content);

    // Special cases for functions like getAllMusicTracks() in JS
    $content = preg_replace('/json_encode\(array_map\(function\(\$track\).*?getAllMusicTracks\(\)\)\)/s', '$musicTracks->map(function($track) { return ["title" => $track->title, "artist" => $track->artist, "src" => asset($track->audio_file), "cover" => $track->cover_image ? asset($track->cover_image) : ""]; })->toJson()', $content);
    
    file_put_contents($file, $content);
}

echo "Views converted.";
