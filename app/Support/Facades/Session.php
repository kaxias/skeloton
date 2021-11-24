<?php

namespace App\Support\Facades;

use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @method static save
 * @method static has(string $name)
 * @method static get(string $name, mixed $default = null)
 * @method static set(string $name, mixed $value)
 * @method static all
 * @method static replace(array $attributes)
 * @method static remove(string $name)
 * @method static clear
 *
 * @see SessionInterface
 */
class Session extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return SessionInterface::class;
    }
}
