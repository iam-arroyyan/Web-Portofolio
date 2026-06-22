<?php

$dir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

foreach($files as $file) {
    $filePath = $file[0];
    $content = file_get_contents($filePath);
    
    // Replace asset($var) with Storage::url($var)
    $newContent = preg_replace('/asset\(\$([a-zA-Z0-9_\-\>\[\]\']+)\)/', 'Storage::url(\$$1)', $content);
    
    if ($newContent !== $content) {
        file_put_contents($filePath, $newContent);
        echo "Updated $filePath\n";
    }
}
echo "Blade files updated.\n";
