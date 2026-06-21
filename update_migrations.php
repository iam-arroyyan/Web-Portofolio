<?php
$dir = __DIR__ . '/database/migrations';
$files = glob($dir . '/*.php');

$schemas = [
    'create_admins_table' => '$table->id(); $table->string("username", 100)->unique(); $table->string("password", 255);',
    'create_site_settings_table' => '$table->id(); $table->string("full_name", 255); $table->string("greeting", 255); $table->text("tagline"); $table->string("profile_image", 500)->default(""); $table->string("footer_name", 255); $table->string("footer_text", 255)->default("");',
    'create_portfolios_table' => '$table->id(); $table->string("title", 255); $table->text("description"); $table->string("image", 500)->default(""); $table->text("tech_stack")->nullable(); $table->string("project_link", 500)->nullable(); $table->timestamp("created_at")->useCurrent();',
    'create_certifications_table' => '$table->id(); $table->string("title", 255); $table->text("description"); $table->string("image", 500)->default(""); $table->timestamp("created_at")->useCurrent();',
    'create_achievements_table' => '$table->id(); $table->string("title", 255); $table->string("year", 10); $table->text("description"); $table->string("image", 500)->default(""); $table->timestamp("created_at")->useCurrent();',
    'create_galleries_table' => '$table->id(); $table->string("image", 500); $table->timestamp("created_at")->useCurrent();',
    'create_music_tracks_table' => '$table->id(); $table->string("title", 255); $table->string("artist", 255); $table->string("audio_file", 500); $table->string("cover_image", 500)->nullable(); $table->timestamps();',
    'create_contacts_table' => '$table->id(); $table->string("platform", 100)->unique(); $table->string("label", 100)->default(""); $table->string("username", 255); $table->string("url", 500)->nullable(); $table->string("icon_class", 100)->default("fas fa-link");',
    'create_comments_table' => '$table->id(); $table->string("nama", 255); $table->text("komentar"); $table->timestamp("created_at")->useCurrent();'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    foreach ($schemas as $key => $schema) {
        if (strpos($file, $key) !== false) {
            $content = preg_replace(
                '/\$table->id\(\);\s*\$table->timestamps\(\);/',
                $schema,
                $content
            );
            file_put_contents($file, $content);
        }
    }
}
echo "Done";
