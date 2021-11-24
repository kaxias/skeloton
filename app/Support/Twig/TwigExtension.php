<?php

namespace App\Support\Twig;

use App\Support\Twig\Extension\AuthRuntime;
use App\Support\Twig\Extension\ConfigRuntime;
use App\Support\Twig\Extension\CsrfRuntime;
use App\Support\Twig\Extension\FlashRuntime;
use App\Support\Twig\Extension\MixRuntime;
use App\Support\Twig\Extension\TwigRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            // slim
            new TwigFunction('url_for', [TwigRuntime::class, 'urlFor']),
            new TwigFunction('full_url_for', [TwigRuntime::class, 'fullUrlFor']),
            new TwigFunction('is_current_url', [TwigRuntime::class, 'isCurrentUrl']),
            new TwigFunction('current_url', [TwigRuntime::class, 'getCurrentUrl']),
            new TwigFunction('get_uri', [TwigRuntime::class, 'getUri']),
            new TwigFunction('base_path', [TwigRuntime::class, 'getBasePath']),
            // mix
            new TwigFunction('asset', [MixRuntime::class, 'asset']),
            new TwigFunction('mix', [MixRuntime::class, 'mix']),
            // csrf
            new TwigFunction('csrf', [CsrfRuntime::class, 'csrf']),
            // config
            new TwigFunction('config', [ConfigRuntime::class, 'config']),
            // auth
            new TwigFunction('auth_check', [AuthRuntime::class, 'check']),
            new TwigFunction('auth_user', [AuthRuntime::class, 'user']),
            // flash
            new TwigFunction('flash_get', [FlashRuntime::class, 'flash_get']),
            new TwigFunction('flash_has', [FlashRuntime::class, 'flash_has']),
            new TwigFunction('flash_all', [FlashRuntime::class, 'flash_all']),
        ];
    }
}
