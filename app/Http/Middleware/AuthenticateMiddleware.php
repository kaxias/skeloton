<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SimpleSlim\App;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class AuthenticateMiddleware implements MiddlewareInterface
{
    protected SessionInterface $session;
    protected ResponseInterface $response;
    protected App $app;

    public function __construct(SessionInterface $session, ResponseInterface $response, App $app)
    {
        $this->session = $session;
        $this->response = $response;
        $this->app = $app;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!$this->session->has('authenticate')) {
            return $this->response
                ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor('auth-login'))
                ->withStatus(302);
        }

        return $handler->handle($request);
    }
}
