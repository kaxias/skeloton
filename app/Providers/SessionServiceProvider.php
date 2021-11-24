<?php

namespace App\Providers;

use App\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class SessionServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            SessionInterface::class => fn() => new Session(new NativeSessionStorage(Config::get('app.session'))),
            FlashBagInterface::class => fn(SessionInterface $session) => $session->getFlashBag(),
        ];
    }
}
