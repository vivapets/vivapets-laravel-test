<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalBreed extends Model
{
    protected $table = 'animals_breeds';

    protected $fillable = [
        'breed_name'
    ];
}
