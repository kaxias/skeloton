<?php

namespace App\Http\Middleware;

use App\Support\Whoops\WhoopsGuard;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

final class WhoopsMiddleware implements MiddlewareInterface
{
    protected WhoopsGuard $whoops;
    protected array $handlers = [];

    public function __construct(WhoopsGuard $guard, array $handlers = [])
    {
        $this->whoops = $guard;
        $this->handlers = $handlers;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $this->whoops->setRequest($request);
        $this->whoops->setHandlers($this->handlers);
        $this->whoops->install();

        return $handler->handle($request);
    }
}
