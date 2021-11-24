<?php

namespace App\Http\Middleware;

use App\Support\Twig\Twig;
use App\Support\Twig\TwigRuntimeLoader;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SimpleSlim\App;
use Slim\Interfaces\RouteParserInterface;

final class TwigMiddleware implements MiddlewareInterface
{
    protected Twig $twig;
    protected RouteParserInterface $routeParser;
    protected string $basePath;
    protected string|null $attributeName;
    protected ?ContainerInterface $container;

    public function __construct(App $app, ?string $attributeName = null)
    {
        $this->container = $app->getContainer();
        $this->twig = $this->container->get(Twig::class);
        $this->routeParser = $app->getRouteCollector()->getRouteParser();
        $this->basePath = $app->getBasePath();
        $this->attributeName = $attributeName;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->twig->addRuntimeLoader(new TwigRuntimeLoader($this->container, $this->routeParser, $request->getUri(), $this->basePath));

        if ($this->attributeName !== null) $request = $request->withAttribute($this->attributeName, $this->twig);

        return $handler->handle($request);
    }
}
