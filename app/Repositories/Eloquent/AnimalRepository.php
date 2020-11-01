<?php

namespace App\Repositories\Eloquent;

use App\Models\Animal;
use App\Repositories\Contracts\AnimalRepositoryInterface;

class AnimalRepository extends BasicRepository implements AnimalRepositoryInterface
{
    protected $model = Animal::class;

    public function __construct(Animal $animal = null) {
        if($animal === null) {
            $this->model = new Animal;
        } else {
            $this->model = $animal;
        }

        parent::__construct($this->model);
    }
    
}