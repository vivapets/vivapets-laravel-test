<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalBreed extends Model
{
    protected $table = 'animals_breeds';

    /**
     * The rules are used to validate a new breed form
     *
     * @var array
     */
    public static $rules = [
        'breed_name' => 'required|string'
    ];

    protected $fillable = [
        'breed_name'
    ];
}
