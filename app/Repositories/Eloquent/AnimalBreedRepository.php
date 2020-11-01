<?php

namespace App\Repositories\Eloquent;

use App\Models\AnimalBreed;
use App\Repositories\Contracts\AnimalBreedRepositoryInterface;

class AnimalBreedRepository extends BasicRepository implements AnimalBreedRepositoryInterface
{
    protected $model;

    public function __construct(AnimalBreed $breed = null) {
        if($breed === null) {
            $this->model = new AnimalBreed;
        } else {
            $this->model = $breed;
        }

        parent::__construct($this->model);
    }
    
}