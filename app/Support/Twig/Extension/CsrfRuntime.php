<?php

namespace App\Support\Twig\Extension;

use Illuminate\Support\HtmlString;
use Psr\Container\ContainerInterface;
use Slim\Csrf\Guard;

class CsrfRuntime
{
    protected Guard $csrf;

    /** @noinspection PhpUnhandledExceptionInspection */
    public function __construct(ContainerInterface $container)
    {
        $this->csrf = $container->get(Guard::class);
    }

    public function csrf(): HtmlString
    {
        return new HtmlString('<input type="hidden" name="'. $this->csrf->getTokenNameKey() .'" value="'. $this->csrf->getTokenName() .'">
<input type="hidden" name="'. $this->csrf->getTokenValueKey() .'" value="'. $this->csrf->getTokenValue() .'">');
    }
}
