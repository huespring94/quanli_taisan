<?php

namespace App\Repositories;

use App\Models\ImportStore;

class ImportStoreRepository
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
