<?php

namespace App\Support\Auth;

use App\Models\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Auth implements AuthInterface
{
    protected SessionInterface $session;
    protected bool $authenticate = false;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

        if ($this->session->has('authenticate')) $this->authenticate = true;
    }

    public function login(string $identifier, string $password): User|bool
    {
        $user = new User();

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) $user = $user->whereEmail($identifier)->where('active', true)->first();
        else $user = $user->whereUsername($identifier)->where('active', true)->first();

        if (!$user) return false;

        if (password_verify($password, $user->password)) {
            $this->authenticate = true;
            $this->session->set('authenticate', $user->id);

            return true;
        }

        return false;
    }

    public function loginById(int $id): User|bool
    {
        $user = new User();

        $user = $user->whereId($id)->first();

        if (!$user) return false;

        $this->authenticate = true;
        $this->session->set('authenticate', $user->id);

        return true;
    }

    public function check(): bool
    {
        return $this->authenticate;
    }

    public function logout(): void
    {
        $this->session->remove('authenticate');
    }

    public function user(): User
    {
        return User::whereId((int)$this->session->get('authenticate'))->first();
    }
}
