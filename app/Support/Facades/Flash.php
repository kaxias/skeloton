<?php

namespace App\Support\Facades;

use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * @method static add(string $type, mixed $message)
 * @method static set(string $type, mixed $messages)
 * @method static peek(string $type, array $default = [])
 * @method static peekAll
 * @method static get(string $type, array $default = [])
 * @method static all
 * @method static setAll(array $messages)
 * @method static has(string $type)
 * @method static keys
 *
 * @see FlashBagInterface
 */
class Flash extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return FlashBagInterface::class;
    }
}
