<?php

use App\Http\Middleware\AuthenticateMiddleware as Authenticate;
use App\Http\Middleware\GuestMiddleware as Guest;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $app) {
    $app->group('/', function (Group $app) {
        $app->get('', 'App\Http\Controllers\WelcomeController::index')
            ->setName('welcome');
        $app->group('auth/', function (Group $app) {
            $app->get('login', 'App\Http\Controllers\Auth\LoginController::loginForm')
                ->add(Guest::class)
                ->setName('auth-login');
            $app->post('login', 'App\Http\Controllers\Auth\LoginController::login');
            $app->get('register', 'App\Http\Controllers\Auth\RegisterController::registerForm')
                ->add(Guest::class)
                ->setName('auth-register');
            $app->post('register', 'App\Http\Controllers\Auth\RegisterController::register');
            $app->get('logout', 'App\Http\Controllers\Auth\LogoutController::logout')
                ->add(Authenticate::class)
                ->setName('logout');
            $app->get('verify-email/{token}', 'App\Http\Controllers\Auth\VerifyUserController::verify')
                ->setName('auth-email_verify');
        });
        $app->group('dashboard/', function (Group $app) {
            $app->get('@{username}', 'App\Http\Controllers\DashboardController::index')
                ->add(Authenticate::class)
                ->setName('dashboard');
        });
    });
};
