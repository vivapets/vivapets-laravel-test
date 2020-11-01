<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BasicRepository implements UserRepositoryInterface
{
    protected $model;

    /**
     * User type ID is created in a seed, so the id is fixed
     */
    const REGULAR_USER_TYPE_ID = 2;

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
        return $this->model->where('type_id', self::REGULAR_USER_TYPE_ID);
    }

    /**
     * Returns the animals in the a specified user
     */
    public function animals()
    {
        return $this->model->animals();
    }

}