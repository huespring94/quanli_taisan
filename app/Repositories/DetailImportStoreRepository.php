<?php

namespace App\Repositories;

use App\Models\DetailImportStore;
use Illuminate\Support\Facades\DB;

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

    /**
     * Calculate quantity in table detail import store by stuff id
     *
     * @param mixed $id
     *
     * @return int
     */
    public function getQuantityByStuffId($id)
    {
        return DB::table('detail_import_stores')->where('stuff_id', '=', $id)->sum('quantity');
    }
    
    public function countAmountImportStore($id)
    {
        return DB::table('detail_import_stores')->where('import_store_id', '=', $id)
            ->sum(DB::raw('price_unit * quantity'));
    }
}
