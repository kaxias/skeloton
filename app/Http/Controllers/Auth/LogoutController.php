<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\Facades\Auth;
use Psr\Http\Message\ResponseInterface as Response;

class LogoutController extends Controller
{
    public function logout(): Response
    {
        Auth::logout();

        return $this->response
            ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor('welcome'))
            ->withStatus(302);
    }
}
