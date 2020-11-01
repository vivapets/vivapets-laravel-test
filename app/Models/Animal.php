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
        return $this->belongsTo(AnimalBreed::class);
    }

    public function type()
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
