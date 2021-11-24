<?php

namespace App\Support\Mailer;

interface MailerInterface
{
    public function subject(string $subject): static;
    public function sendTo(string $to, string $name): static;
    public function renderHtmlMail(string $body, array $data = []): static;
    public function send();
}
