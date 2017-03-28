<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
