<?php

namespace App\Support\Facades;

use Illuminate\Contracts\Config\Repository;
use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;

/**
 * @method static has(string $key)
 * @method static get(string $key, mixed $default = null)
 * @method static all
 * @method static set(string $key, mixed $value = null)
 * @method static prepend(string $key, mixed $value)
 * @method static push(string $key, mixed $value)
 *
 * @see Repository
 */
class Config extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return Repository::class;
    }
}
