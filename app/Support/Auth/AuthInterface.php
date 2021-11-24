<?php

namespace App\Support\Auth;

use App\Models\User;

interface AuthInterface
{
    public function login(string $identifier, string $password): User|bool;
    public function loginById(int $id): User|bool;
    public function check(): bool;
    public function logout(): void;
    public function user(): User;
}
