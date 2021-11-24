<?php

namespace App\Providers;

use App\Support\Facades\Config;
use App\Support\Mailer\Mailer;
use App\Support\Mailer\MailerInterface;
use App\Support\Twig\Twig;

class MailerServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            MailerInterface::class => fn(Twig $twig) => new Mailer($twig, Config::get('app.mailer')),
        ];
    }
}
