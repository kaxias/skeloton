<?php
/**
 * @noinspection PhpUnhandledExceptionInspection
 * @noinspection PhpUnused
 */

namespace App\Support\Twig;

use ArrayAccess;
use ArrayIterator;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;
use Twig\Extension\ExtensionInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class Twig implements ArrayAccess
{
    protected ResponseInterface $response;
    protected LoaderInterface $loader;
    protected Environment $environment;
    protected array $defaultVariables = [];

    public static function create(ResponseInterface $response, string $path, array $settings = []): Twig
    {
        $loader = new FilesystemLoader();

        $paths = is_array($path) ? $path : [$path];
        foreach ($paths as $namespace => $path) {
            if (is_string($namespace)) $loader->setPaths($path, $namespace);
            else $loader->addPath($path);
        }

        return new static($response, $loader, $settings);
    }

    public function __construct(ResponseInterface $response, LoaderInterface $loader, array $settings = [])
    {
        $this->response = $response;
        $this->loader = $loader;
        $this->environment = new Environment($this->loader, $settings);
        $extension = new TwigExtension();
        $this->addExtension($extension);
    }

    public function addExtension(ExtensionInterface $extension): void
    {
        $this->environment->addExtension($extension);
    }

    public function addRuntimeLoader(RuntimeLoaderInterface $runtimeLoader): void
    {
        $this->environment->addRuntimeLoader($runtimeLoader);
    }

    public function fetch(string $template, array $data = []): string
    {
        $data = array_merge($this->defaultVariables, $data);

        return $this->environment->render($template, $data);
    }

    public function fetchBlock(string $template, string $block, array $data = []): string
    {
        $data = array_merge($this->defaultVariables, $data);

        return $this->environment->resolveTemplate($template)->renderBlock($block, $data);
    }

    public function fetchFromString(string $string = '', array $data = []): string
    {
        $data = array_merge($this->defaultVariables, $data);

        return $this->environment->createTemplate($string)->render($data);
    }

    public function render(string $template, array $data = []): ResponseInterface
    {
        $this->response->getBody()->write($this->fetch($template, $data));

        return $this->response;
    }

    public function getLoader(): LoaderInterface
    {
        return $this->loader;
    }

    public function getEnvironment(): Environment
    {
        return $this->environment;
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->defaultVariables);
    }

    /** @noinspection PhpPureAttributeCanBeAddedInspection */
    public function offsetGet($offset): mixed
    {
        if (!$this->offsetExists($offset)) return null;
        return $this->defaultVariables[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->defaultVariables[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->defaultVariables[$offset]);
    }

    public function count(): int
    {
        return count($this->defaultVariables);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->defaultVariables);
    }
}
