<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Store::class;
    }
}
