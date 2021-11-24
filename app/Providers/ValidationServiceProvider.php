<?php

namespace App\Providers;

use App\Http\Middleware\ValidationErrorsMiddleware;
use App\Support\Twig\Twig;
use App\Support\Validation\Rules\Unique;
use Illuminate\Database\Capsule\Manager;
use Rakit\Validation\Validator;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ValidationServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            Validator::class => function(Manager $manager) {
                $validator = new Validator();
                $validator->addValidator('unique', new Unique($manager->getConnection()));

                return $validator;
            },
            ValidationErrorsMiddleware::class => fn(Twig $twig, SessionInterface $session) => new ValidationErrorsMiddleware($twig, $session),
        ];
    }
}
