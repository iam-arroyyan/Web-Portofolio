<?php
$dir = __DIR__ . '/app/Models';
$files = glob($dir . '/*.php');

foreach ($files as $file) {
    if (strpos($file, 'User.php') !== false) continue;
    $content = file_get_contents($file);
    
    $insert = "    protected \$guarded = [];\n";
    if (strpos($file, 'MusicTrack.php') === false) {
        $insert .= "    public \$timestamps = false;\n";
    }
    
    // Insert after the class declaration opening brace
    $content = preg_replace('/\{/', "{\n" . $insert, $content, 1);
    file_put_contents($file, $content);
}
echo "Models updated.";
