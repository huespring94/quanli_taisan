<?php

namespace App\Repositories;

use App\Models\StoreFaculty;

class StoreFacultyRepository extends BaseRepo
{

    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return StoreFaculty::class;
    }
}
