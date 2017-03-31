<?php

namespace App\Repositories;

use App\Models\ImportStore;
use App\Repositories\BaseRepo;

class ImportStoreRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return ImportStore::class;
    }
}
