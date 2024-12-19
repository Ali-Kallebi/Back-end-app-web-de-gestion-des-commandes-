<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AuthenticatableContract, CanResetPasswordContract, MustVerifyEmailContract
{
    use HasFactory, AuthenticatableTrait, HasApiTokens, CanResetPasswordTrait, Notifiable, MustVerifyEmailTrait;

    protected $table = 'users';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'tel',
        'specialite',
        'localisation',
        'password',
        'avatar',
        'nombreCommandesTerminees',
        'periode',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        
    ];
}
