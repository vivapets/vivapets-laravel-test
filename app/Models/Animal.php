<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name', 'age', 'photo', 'breed_id', 'type_id', 'user_id'
    ];

    public function breed()
    {
        return $this->belongsTo('App\Models\AnimalBreed');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\AnimalType');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
