<?php

namespace App\Support\Twig;

use App\Support\Twig\Extension\AuthRuntime;
use App\Support\Twig\Extension\ConfigRuntime;
use App\Support\Twig\Extension\CsrfRuntime;
use App\Support\Twig\Extension\FlashRuntime;
use App\Support\Twig\Extension\MixRuntime;
use App\Support\Twig\Extension\TwigRuntime;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\UriInterface;
use Slim\Interfaces\RouteParserInterface;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{
    protected RouteParserInterface $routeParser;
    protected UriInterface $uri;
    protected string $basePath = '';
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container, RouteParserInterface $routeParser, UriInterface $uri, string $basePath = '')
    {
        $this->container = $container;
        $this->routeParser = $routeParser;
        $this->uri = $uri;
        $this->basePath = $basePath;
    }

    public function load(string $class): mixed
    {
        if (TwigRuntime::class === $class) return new $class($this->routeParser, $this->uri, $this->basePath);
        if (MixRuntime::class === $class) return new $class($this->container);
        if (CsrfRuntime::class === $class) return new $class($this->container);
        if (ConfigRuntime::class === $class) return new $class();
        if (AuthRuntime::class === $class) return new $class();
        if (FlashRuntime::class === $class) return new $class();

        return null;
    }
}
