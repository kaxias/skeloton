<?php

namespace App\Support\Twig\Extension;

use App\Support\Facades\Config;

class ConfigRuntime
{
    public function config(string $key, mixed $default = null)
    {
        return Config::get($key, $default);
    }
}
