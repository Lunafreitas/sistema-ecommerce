<?php

namespace App\Models;

use App\Enums\UserLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nivel',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Faz o Laravel entender o 'nivel' como o Enum UserLevel
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'nivel' => UserLevel::class, 
    ];

    // Helpers profissionais para checagem de permissão
    public function isAdmin(): bool
    {
        return $this->nivel === UserLevel::ADMIN;
    }

    public function isSeller(): bool
    {
        return $this->nivel === UserLevel::VENDEDOR;
    }

    public function isClient(): bool
    {
        return $this->nivel === UserLevel::CLIENTE;
    }

    public function sellerProfile(): HasOne
    {
        return $this->hasOne(Seller::class);
    }
}
