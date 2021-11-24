<?php

namespace App\Providers;

use SimpleSlim\App;
use SimpleSlim\ProviderInterface;

class ServiceProvider implements ProviderInterface
{
    public function register(): array
    {
        return [];
    }

    public function boot(App $app): void
    {
        //
    }
}
