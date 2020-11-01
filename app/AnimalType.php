<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalType extends Model
{
    protected $table = 'animals_types';

    protected $fillable = [
        'name'
    ];
}
