<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type_id', 'is_banned'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The rules are used to validate a new user form
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed'
    ];

    /**
     * The login rules are used to validade login forms
     *
     * @var array
     */
    public static $loginRules = [
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean'
    ];

    /**
     * User type
     */
    public function type()
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * Get animals by users
     */
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
