<?php

use Illuminate\Support\Str;

// Neon: DATABASE_URL adalah satu-satunya kredensial DB yang dipakai.
// Format: postgres://user:password@host/db?sslmode=require
// Laravel 12: parse_url di sini agar host/port/db/user/pass terurai dari URL.
$url = env('DATABASE_URL');
$parts = $url ? parse_url($url) : [];
$query = [];
if (!empty($parts['query'])) {
    parse_str($parts['query'], $query);
}

return [
    'default' => env('DB_CONNECTION', $url ? 'pgsql' : 'sqlite'),
    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => $url,
            'host' => $parts['host'] ?? env('DB_HOST', '127.0.0.1'),
            'port' => $parts['port'] ?? env('DB_PORT', '5432'),
            'database' => isset($parts['path']) ? ltrim($parts['path'], '/') : env('DB_DATABASE', 'laravel'),
            'username' => $parts['user'] ?? env('DB_USERNAME', 'postgres'),
            'password' => isset($parts['pass']) ? urldecode($parts['pass']) : env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => $query['sslmode'] ?? 'require',
        ],
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],
    ],
    'migrations' => 'migrations',
    'redis' => ['client' => env('REDIS_CLIENT', 'phpredis'), 'default' => ['url' => env('REDIS_URL'), 'host' => env('REDIS_HOST', '127.0.0.1'), 'port' => env('REDIS_PORT', '6379'), 'database' => env('REDIS_DB', '0')]],
];
