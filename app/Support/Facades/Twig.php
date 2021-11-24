<?php

namespace App\Support\Facades;

use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;

/**
 * @method static render(string $template, array $data = [])
 * @method static fetchFromString(string $string = '', array $data = [])
 * @method static fetchBlock(string $template, string $block, array $data = [])
 * @method static fetch(string $template, array $data = [])
 *
 * @see \App\Support\Twig\Twig
 */
class Twig extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return \App\Support\Twig\Twig::class;
    }
}
