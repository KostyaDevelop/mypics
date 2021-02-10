<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'login',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function getLogin(int $id) : string
    {
        $login = self::where('id', $id)
            ->first()
            ->login;
        return $login;
    }
    protected function getEmail(int $id) : string
    {
        $email = self::where('id', $id)
            ->first()
            ->email;
        return $email;
    }
    protected function getName(int $id) : string
    {
        $name = self::where('id', $id)
            ->first()
            ->name;
        return $name;
    }
}
