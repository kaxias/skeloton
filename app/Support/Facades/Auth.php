<?php

namespace App\Support\Facades;

use App\Models\User;
use App\Support\Auth\AuthInterface;
use SimpleSlim\Facade;
use SimpleSlim\FacadeInterface;

/**
 * @method static User|bool login(string $identifier, string $password)
 * @method static User|bool loginById(int $id)
 * @method static bool check
 * @method static void logout
 * @method static User user
 *
 * @see AuthInterface
 */
class Auth extends Facade implements FacadeInterface
{
    public static function getFacadeAccessor(): string
    {
        return AuthInterface::class;
    }
}
