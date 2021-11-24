<?php

namespace App\Support\Mailer;

use App\Support\Twig\Twig;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer extends PHPMailer implements MailerInterface
{
    protected array $config = [];
    public Twig $twig;

    public function __construct(Twig $twig, array $config = [])
    {
        $this->twig = $twig;
        $this->config = $config;
        parent::__construct($config['exceptions']);
        $this->exceptions = $config['exceptions'];

        $this->initPHPMailer();
    }

    protected function initPHPMailer(): void
    {
        $this->isSMTP();
        $this->Host = $this->config['host'];
        $this->SMTPAuth = true;
        $this->Username = $this->config['username'];
        $this->Password = $this->config['password'];
        $this->SMTPSecure = 'tls';
        $this->Port = $this->config['port'];
        $this->From = $this->config['from'];
        $this->FromName = $this->config['from_name'];
    }

    public function subject(string $subject): static
    {
        $this->Subject = $subject;

        return $this;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function sendTo(string $to, string $name): static
    {
        $this->addAddress($to, $name);
        $this->addReplyTo($to);
        $this->addCC($to);
        $this->addBCC($to);

        return $this;
    }

    public function renderHtmlMail(string $body, array $data = []): static
    {
        $this->isHTML();
        $this->Body = $this->twig->render('emails/' . $body, $data);

        return $this;
    }
}
