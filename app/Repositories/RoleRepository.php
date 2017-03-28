<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }
}
