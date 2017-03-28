<?php

namespace App\Repositories;

use App\Models\Stuff;

class StuffRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Stuff::class;
    }
}
