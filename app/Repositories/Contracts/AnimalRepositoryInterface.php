<?php

namespace App\Repositories\Contracts;

use App\Models\Animal;

interface AnimalRepositoryInterface
{
    public function all();
    public function paginate();
}