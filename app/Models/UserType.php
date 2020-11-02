<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    /**
     * User type ID is created in a seed, so the id is fixed
     */
    const REGULAR_USER_TYPE_ID = 2;

    protected $table = 'users_types';

    protected $fillable = [
        'name'
    ];

    public static function registerTypeID()
    {
        return self::REGULAR_USER_TYPE_ID;
    }
}
