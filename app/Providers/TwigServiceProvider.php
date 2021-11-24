<?php

namespace App\Providers;

use App\Support\Twig\Twig;
use App\Support\Facades\Config;
use Psr\Http\Message\ResponseInterface;

class TwigServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            Twig::class => fn(ResponseInterface $response) => Twig::create($response, Config::get('twig.path'), Config::get('twig.settings')),
        ];
    }
}
