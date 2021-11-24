<?php

namespace App\Http\Middleware;

use App\Support\Facades\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SimpleSlim\App;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class GuestMiddleware implements MiddlewareInterface
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
        if ($this->session->has('authenticate')) {
            $user = Auth::user();
            return $this->response
                ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor('dashboard', ['username' => $user->username]))
                ->withStatus(302);
        }

        return $handler->handle($request);
    }
}
