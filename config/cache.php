<?php

return [
    'default' => env('CACHE_STORE', 'database'),
    'stores' => [
        'database' => ['driver' => 'database', 'connection' => env('DB_CACHE_CONNECTION'), 'table' => env('DB_CACHE_TABLE', 'cache')],
        'file' => ['driver' => 'file', 'path' => storage_path('framework/cache/data'), 'lock_path' => storage_path('framework/cache/data')],
        'array' => ['driver' => 'array', 'serialize' => false],
    ],
    'prefix' => env('CACHE_PREFIX', 'donasi_relawan_cache'),
];
