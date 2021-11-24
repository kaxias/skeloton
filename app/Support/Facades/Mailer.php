<?php

namespace App\Support\Facades;

use App\Support\Mailer\MailerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;

/**
 * @method static \App\Support\Mailer\Mailer subject(string $subject)
 * @method static sendTo(string $to, string $name)
 * @method static renderHtmlMail(string $body, array $data = [])
 * @method static PHPMailer send
 *
 * @see MailerInterface
 */
class Mailer extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return MailerInterface::class;
    }
}
