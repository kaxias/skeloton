<?php

namespace App\Support\Facades;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;

/**
 * @method static getStatusCode
 * @method static withStatus(int $code, string $reasonPhrase = '')
 * @method static getReasonPhrase
 * @method static getProtocolVersion
 * @method static withProtocolVersion(string $version)
 * @method static getHeaders
 * @method static hasHeader(string $name)
 * @method static getHeader(string $name)
 * @method static getHeaderLine(string $name)
 * @method static withHeader(string $name, string|string[] $value)
 * @method static withAddedHeader(string $name, string|string[] $value)
 * @method static withoutHeader(string $name)
 * @method static getBody
 * @method static withBody(StreamInterface $body)
 *
 * @see ResponseInterface
 * @see \Psr\Http\Message\MessageInterface
 */
class Response extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return ResponseInterface::class;
    }
}
