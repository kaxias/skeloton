<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property integer $id
 * @property integer $active
 * @property string $username
 * @property string $email
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Token $token
 * @method static User|Model whereId(int $id)
 * @method static User|Model whereUsername(string $username)
 * @method static User|Model whereEmail(string $email)
 * @method static User|Model wherePassword(string $password)
 *
 * @mixin Builder|Model
 */
class User extends Model
{
    /** @var array[] $fillable */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /** @var array[] $hidden */
    protected $hidden = ['password'];

    /** @noinspection PhpUnused */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_ARGON2ID);
    }
}
