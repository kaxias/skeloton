<?php

use Illuminate\Support\Str;

return [
    'name' => env('APP_NAME'),
    'url' => env('APP_URL'),
    'key' => env('APP_KEY'),
    'whoops' => [
        'enable' => env('APP_WHOOPS_ENABLE'),
        'editor' => 'phpstorm',
        'title'  => '',
    ],
    'mailer' => [
        'exceptions' => null,
        'host' => env('MAIL_HOST'),
        'port' => env('MAIL_PORT'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'from' => env('MAIL_FROM'),
        'from_name' => env('MAIL_FROM_NAME'),
    ],
    'session' => [
        'name' => Str::slug(env('APP_NAME')),
        'cache_expire' => 0,
        'cookie_httponly' => true,
        'cookie_secure' => true,
        'cache_limiter' => 'nocache',
        'gc_probability' => 1,
        'gc_divisor' => 1,
        'save_path' => rtrim(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage\cache\session', '\/'),
        'gc_maxlifetime' => 60 * 60,
    ],
];
