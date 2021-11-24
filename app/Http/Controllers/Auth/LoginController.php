<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\Facades\Auth;
use App\Support\Facades\Flash;
use App\Support\Facades\Session;
use App\Support\Facades\Twig;
use Psr\Http\Message\ResponseInterface as Response;

class LoginController extends Controller
{
    public function loginForm(): Response
    {
        return Twig::render('auth/login.twig');
    }

    public function login(): Response
    {
        $this->validate($this->rules());

        if ($this->validation->fails()) {
            Session::set('errors', $this->validation->errors->firstOfAll());

            return $this->response->withHeader('Location', (string)$this->request->getUri())->withStatus(302);
        }

        $data = $this->request->getParsedBody();
        $user = Auth::login($data['identifier'], $data['password']);
        if (!$user) {
            Flash::set('danger', 'Could not sign you in with those details');

            return $this->response->withHeader('Location', (string)$this->request->getUri())->withStatus(302);
        }

        return $this->response
            ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor('dashboard', ['username' => Auth::user()->username]))
            ->withStatus(302);
    }

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    protected function rules(): array
    {
        return [
            'identifier' => 'required|min:2|max:255',
            'password' => 'required|min:7|max:255',
        ];
    }
}
