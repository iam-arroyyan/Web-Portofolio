<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS portfolio_nadya');
    echo "Database created.\n";

    $pdo->exec('USE portfolio_nadya');
    $sql = file_get_contents(__DIR__ . '/legacy_backup/database/portfolio_nadya.sql');
    
    // Some PDO drivers don't support multi-query via exec well for huge dumps.
    // However, it's worth a try.
    $pdo->exec($sql);
    echo "Database imported successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
