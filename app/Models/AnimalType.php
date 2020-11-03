<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalType extends Model
{
    protected $table = 'animals_types';

    /**
     * The rules are used to validate a new breed form
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string'
    ];

    protected $fillable = [
        'name'
    ];
}
