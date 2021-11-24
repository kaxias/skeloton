<?php

namespace App\Support\Twig\Extension;

use App\Models\User;
use App\Support\Facades\Auth;

class AuthRuntime
{
    public function check(): bool
    {
        return Auth::check();
    }

    public function user(): User
    {
        return Auth::user();
    }
}
