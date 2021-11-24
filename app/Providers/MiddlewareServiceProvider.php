<?php

namespace App\Providers;

use App\Http\Middleware\SessionMiddleware;
use App\Http\Middleware\TwigMiddleware;
use App\Http\Middleware\ValidationErrorsMiddleware;
use App\Http\Middleware\WhoopsMiddleware;
use App\Support\Twig\Twig;
use App\Support\Facades\Config;
use App\Support\Whoops\WhoopsGuard;
use SimpleSlim\App;
use Slim\Csrf\Guard;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MiddlewareServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            Guard::class => fn(App $app) => new Guard($app->getResponseFactory()),
            SessionMiddleware::class => fn(SessionInterface $session) => new SessionMiddleware($session),
            TwigMiddleware::class => fn(App $app) => new TwigMiddleware($app, Twig::class),
            WhoopsGuard::class => fn() => new WhoopsGuard(Config::get('app.whoops')),
            WhoopsMiddleware::class => fn(WhoopsGuard $guard) => new WhoopsMiddleware($guard, []),
        ];
    }

    public function boot(App $app): void
    {
        $app->add(ValidationErrorsMiddleware::class);
        $app->add(Guard::class);
        $app->add(SessionMiddleware::class);
        $app->add(TwigMiddleware::class);
        $app->addRoutingMiddleware();
        if (Config::get('app.whoops.enable')) $app->add(WhoopsMiddleware::class);
        else $app->addErrorMiddleware(true, true, true);
    }
}
