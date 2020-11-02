<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\UserType;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BasicRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user = null) {
        if($user === null) {
            $this->model = new User;
        } else {
            $this->model = $user;
        }

        parent::__construct($this->model);
    }
    
    /**
     * Filter only users with type regular, admin users are not supposed to be available through api
     */
    public function onlyRegularUsers()
    {
        return $this->model->where('type_id', UserType::registerTypeID());
    }

    /**
     * Returns the animals in the a specified user
     */
    public function animals()
    {
        return $this->model->animals();
    }

}