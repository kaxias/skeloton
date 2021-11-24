<?php

namespace App\Support\Facades;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;

/**
 * @method static array getServerParams
 * @method static array getCookieParams
 * @method static withCookieParams(array $cookies)
 * @method static getQueryParams
 * @method static withQueryParams(array $query)
 * @method static getUploadedFiles
 * @method static withUploadedFiles(array $uploadedFiles)
 * @method static getParsedBody
 * @method static withParsedBody($data)
 * @method static getAttributes
 * @method static getAttribute(string $name, mixed $default = null)
 * @method static withAttribute(string $name, mixed $default)
 * @method static withoutAttribute(string $name)
 * @method static getRequestTarget
 * @method static withRequestTarget(mixed $requestTarget)
 * @method static getMethod
 * @method static withMethod(string $method)
 * @method static getUri
 * @method static withUri(UriInterface $uri, bool $preserveHost = false)
 *
 * @see ServerRequestInterface
 */
class Request extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return ServerRequestInterface::class;
    }
}
