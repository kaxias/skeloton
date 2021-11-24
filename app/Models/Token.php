<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property integer $id
 * @property integer $userId
 * @property string $references
 * @property string $token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|User $user
 * @method static Token|Model whereId(int $id)
 * @method static Token|Model whereUserId(int $id)
 * @method static Token|Model whereReferences(string $username)
 * @method static Token|Model whereToken(string $email)
 *
 * @mixin Builder|Model
 */
class Token extends Model
{
    /** @var array[] $fillable */
    protected $fillable = [
        'user_id', 'references', 'token',
    ];

    /** @noinspection PhpUnused */
    public function setTokenAttribute(string $value): void
    {
        $this->attributes['token'] = hash('haval160,4', $value);
    }

    public function user(): BelongsTo|User
    {
        return $this->belongsTo(User::class);
    }
}
