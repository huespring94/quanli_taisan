<?php

namespace App\Repositories;

use App\Models\Atrophy;

class AtrophyRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Atrophy::class;
    }
}
