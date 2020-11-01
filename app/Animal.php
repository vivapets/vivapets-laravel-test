<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name', 'age', 'post', 'breed_id', 'type_id', 'user_id'
    ];

    public function breed()
    {
        return $this->belongsTo('App\AnimalBreed');
    }

    public function type()
    {
        return $this->belongsTo('App\AnimalType');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
