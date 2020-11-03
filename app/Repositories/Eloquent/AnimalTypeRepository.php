<?php

namespace App\Repositories\Eloquent;

use App\Models\AnimalType;
use App\Repositories\Contracts\AnimalTypeRepositoryInterface;

class AnimalTypeRepository extends BasicRepository implements AnimalTypeRepositoryInterface
{
    protected $model;

    public function __construct(AnimalType $type = null) {
        if($type === null) {
            $this->model = new AnimalType;
        } else {
            $this->model = $type;
        }

        parent::__construct($this->model);
    }
    
}