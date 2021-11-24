<?php

namespace App\Providers;

use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Support\Auth\Auth;
use App\Support\Auth\AuthInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleSlim\App;
use Slim\Psr7\Factory\ServerRequestFactory;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AppServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            ResponseInterface::class => fn(App $app) => $app->getResponseFactory()->createResponse(),
            ServerRequestInterface::class => fn() => ServerRequestFactory::createFromGlobals(),
            AuthInterface::class => fn(SessionInterface $session) => new Auth($session),
            AuthenticateMiddleware::class => fn(SessionInterface $session, ResponseInterface $response, App $app) => new AuthenticateMiddleware($session, $response, $app),
            GuestMiddleware::class => fn(SessionInterface $session, ResponseInterface $response, App $app) => new GuestMiddleware($session, $response, $app),
        ];
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function boot(App $app): void
    {
        $app->getContainer()->set(App::class, $app);
    }
}
