<?php

require __DIR__ . "/bootstrap/app.php";

return [
    'paths' => [
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__ . '/database/seeds'
    ],
    'migration_base_class' => 'App\Support\Database\Migration',
    'templates' => [
        'file' => __DIR__ . '/app/Support/Database/migrations.stubs'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => env('DB_CONNECTION'),
        'sqlite' => [
            'adapter' => env('DB_CONNECTION'),
            'name' => env('DB_DATABASE'),
            'suffix' => ".sqlite3",
        ],
        'mysql' => [
            'adapter' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'port' => env('DB_PORT'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ]
    ],
    'version_order' => 'creation'
];
