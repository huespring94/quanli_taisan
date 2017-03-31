<?php

namespace App\Repositories;

use App\Models\Faculty;

class FacultyRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Faculty::class;
    }
}
