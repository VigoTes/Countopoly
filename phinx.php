<?php

// Framework bootstrap code here
require_once __DIR__ . '/bootstrap/app.php';

// Get PDO object
$pdo = new PDO(
    'mysql:host=127.0.0.1;dbname=countopoly2;charset=utf8', 'root', '123456',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_unicode_ci',
    )
);

return [
    'paths' => [
        'migrations' => __DIR__ . '/phinx/migrations',
    ],
    'schema_file' => __DIR__ . '/phinx/schema/schema.php',
    'foreign_keys' => false,
    'default_migration_prefix' => '',
    'mark_generated_migration' => true,
    'environments' => [
        'default_environment' => 'local',
        'local' => [
            // Database name
            'name' => $pdo->query('select database()')->fetchColumn(),
            'connection' => $pdo,
        ]
    ]
];