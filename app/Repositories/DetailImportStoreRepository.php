<?php

namespace App\Repositories;

use App\Models\DetailImportStore;

class DetailImportStoreRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return DetailImportStore::class;
    }
}
