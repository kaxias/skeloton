<?php

namespace App\Support\Facades;

use Rakit\Validation\Validation;
use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;

/**
 * @method static Validation make(array $inputs, array $rules, array $messages = [])
 *
 * @see \Rakit\Validation\Validator
 */
class Validator extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return \Rakit\Validation\Validator::class;
    }
}
