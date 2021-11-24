<?php

namespace App\Http\Middleware;

use App\Support\Twig\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\TwigFunction;

final class ValidationErrorsMiddleware implements MiddlewareInterface
{
    protected Twig $twig;
    protected SessionInterface $session;

    public function __construct(Twig $twig, SessionInterface $session)
    {
        $this->twig = $twig;
        $this->session = $session;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $errors = $this->session->get('errors');
        $fields = $this->session->get('old_fields');

        $this->twig->getEnvironment()->addFunction(new TwigFunction('any_error', fn() => !empty($errors)));
        $this->twig->getEnvironment()->addFunction(new TwigFunction('has_error', fn($name) => !empty($errors[$name])));
        $this->twig->getEnvironment()->addFunction(new TwigFunction('get_error', fn($name) => empty($errors[$name]) ? '' : (string)$errors[$name]));
        $this->twig->getEnvironment()->addFunction(new TwigFunction('old', fn($name) => !empty($fields[$name]) ? $fields[$name] : ''));

        $this->session->remove('errors');
        $this->session->remove('old_fields');

        return $handler->handle($request);
    }
}
