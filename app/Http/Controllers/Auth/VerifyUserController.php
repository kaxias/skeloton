<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Support\Facades\Config;
use App\Support\Facades\Mailer;
use Illuminate\Support\Carbon;
use Psr\Http\Message\ResponseInterface as Response;

class VerifyUserController extends Controller
{
    public function verify(string $token): Response
    {
        $token = Token::whereToken($token)->first();
        $now = Carbon::now();
        $start = Carbon::createFromTimeString($token->updated_at);
        $end = Carbon::createFromTimeString($token->updated_at)->addHours(2);

        if ($now->between($start, $end)) {
            $token->user->active = true;
            $token->user->save();
            $token->delete();

            return $this->response
                ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor('auth-login'))
                ->withStatus(302);
        }

        $token->references = 'register update token';
        $token->token = hash('haval160,4', Config::get('app.key'));
        $token->save();

        /** @noinspection PhpUnhandledExceptionInspection */
        Mailer::subject('Welcome To ' . Config::get('app.name'))
            ->sendTo($token->user->email, $token->user->username)
            ->renderHtmlMail('welcome.twig', ['user' => $token->user, 'bodyMessage' => 'Welcome to ' . Config::get('app.name'), 'token' => $token->token])
            ->send();

        return $this->response
            ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor('auth-login'))
            ->withStatus(302);
    }
}
