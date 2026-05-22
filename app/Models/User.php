<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\BelongsToTenant;
use App\Traits\HasFriendlyId;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

#[Fillable(['name', 'unit_id', 'email', 'password', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use BelongsToTenant, HasFriendlyId, HasFactory, Notifiable, SoftDeletes;

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            // Se quem está criando é um usuário logado e não foi passado um ID de unidade fixo
            if (auth('api')->check() && ! $user->unit_id) {
                $user->unit_id = auth('api')->user()->unit_id;
            }
        });


    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Retorna a chave primária do utilizador (ID)
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Permite adicionar informações personalizadas ao token se desejares
    public function getJWTCustomClaims()
    {
        return [
            "admin" => true,
        ];
    }

    /**
     * Relacionamento: O usuário possui uma unidade padrão.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
