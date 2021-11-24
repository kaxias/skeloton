<?php
/** @noinspection PhpUnused */

namespace App\Support\Twig\Extension;

use Psr\Http\Message\UriInterface;
use Slim\Interfaces\RouteParserInterface;

class TwigRuntime
{
    protected RouteParserInterface $routeParser;
    protected string $basePath = '';
    protected UriInterface $uri;

    public function __construct(RouteParserInterface $routeParser, UriInterface $uri, string $basePath = '')
    {
        $this->routeParser = $routeParser;
        $this->uri = $uri;
        $this->basePath = $basePath;
    }

    public function urlFor(string $routeName, array $data = [], array $queryParams = []): string
    {
        return $this->routeParser->urlFor($routeName, $data, $queryParams);
    }

    public function fullUrlFor(string $routeName, array $data = [], array $queryParams = []): string
    {
        return $this->routeParser->fullUrlFor($this->uri, $routeName, $data, $queryParams);
    }

    public function isCurrentUrl(string $routeName, array $data = []): bool
    {
        $currentUrl = $this->basePath . $this->uri->getPath();
        $result = $this->routeParser->urlFor($routeName, $data);

        return $result === $currentUrl;
    }

    public function getCurrentUrl(bool $withQueryString = false): string
    {
        $currentUrl = $this->basePath . $this->uri->getPath();
        $query = $this->uri->getQuery();

        if ($withQueryString && !empty($query)) $currentUrl .= '?' . $query;

        return $currentUrl;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function setUri(UriInterface $uri): TwigRuntime
    {
        $this->uri = $uri;

        return $this;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function setBasePath(string $basePath): TwigRuntime
    {
        $this->basePath = $basePath;

        return $this;
    }
}
