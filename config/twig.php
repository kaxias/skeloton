<?php

return [
    'path' => rtrim(dirname(__DIR__) . '\resources\views', '\/'),
    'settings' => [
        'debug' => false,
        'charset' => 'UTF-8',
        'strict_variables' => false,
        'autoescape' => 'html',
        'cache' => rtrim(dirname(__DIR__) . '\storage\cache\twig', '\/'),
//        'cache' => false,
        'auto_reload' => true,
        'optimizations' => -1,
    ],
];
