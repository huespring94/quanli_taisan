<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Supplier::class;
    }
}
