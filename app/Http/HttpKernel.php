<?php

namespace App\Http;

use SimpleSlim\Kernel;

class HttpKernel extends Kernel
{
    protected array $providers = [
        \App\Providers\AppServiceProvider::class,
        \App\Providers\ConfigServiceProvider::class,
        \App\Providers\DatabaseServiceProvider::class,
        \App\Providers\SessionServiceProvider::class,
        \App\Providers\TwigServiceProvider::class,
        \App\Providers\ValidationServiceProvider::class,
        \App\Providers\MailerServiceProvider::class,
        \App\Providers\MiddlewareServiceProvider::class,
    ];
}
