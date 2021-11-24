<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Models\User;
use App\Support\Facades\Config;
use App\Support\Facades\Mailer;
use App\Support\Facades\Session;
use App\Support\Facades\Twig;
use Illuminate\Database\Eloquent\Model;
use Psr\Http\Message\ResponseInterface as Response;

class RegisterController extends Controller
{
    public function registerForm(): Response
    {
        return Twig::render('auth/register.twig');
    }

    public function register(): Response
    {
        $this->validate($this->rules());
        if ($this->validation->fails()) {
            Session::set('errors', $this->validation->errors->firstOfAll());

            return $this->response->withHeader('Location', (string)$this->request->getUri())->withStatus(302);
        }

        $user = $this->create($this->request->getParsedBody());

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $token = Token::create([
            'user_id' => $user->id,
            'references' => 'register',
            'token' => Config::get('app.key'),
        ]);

        /** @noinspection PhpUnhandledExceptionInspection */
        Mailer::subject('Welcome To ' . Config::get('app.name'))
            ->sendTo($user->email, $user->username)
            ->renderHtmlMail('welcome.twig', ['user' => $user, 'bodyMessage' => 'Welcome to ' . Config::get('app.name'), 'token' => $token->token])
            ->send();

        return $this->response
            ->withHeader('Location', $this->app->getRouteCollector()->getRouteParser()->urlFor('auth-login'))
            ->withStatus(302);
    }

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    protected function rules(): array
    {
        return [
            'username' => 'required|min:3|max:255|unique:users,username',
            'email' => 'required|email|min:5|max:255|unique:users,email',
            'password' => 'required|min:7|max:255',
            'password_confirmation' => 'required|same:password',
        ];
    }

    /** @noinspection PhpDynamicAsStaticMethodCallInspection */
    protected function create(array $data): Model|User
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}
