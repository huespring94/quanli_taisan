<?php

namespace App\Repositories;

use App\Models\Liquidation;
use DB;

class LiquidationRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Liquidation::class;
    }
    
    /**
     * Get all liquidations for store
     *
     * @return array
     */
    public function getAllLiquidation()
    {
        return $this->with([
                    'detailImportStore.importStore',
                    'storeFaculty.stuff', 'storeFaculty.detailImportStore',
                    'storeRoom.stuff', 'storeRoom.storeFaculty.detailImportStore'
                ])
                ->orderBy('created_at', 'desc')
                ->all();
    }
    
    /**
     * Get store faculty by year and faculty group by stuff
     *
     * @return mixed
     */
    public function getAllLiquidationShort()
    {
        return Liquidation::with([
                    'detailImportStore.stuff',
                    'detailImportStore.importStore'
                ])
            ->select('detail_import_store_id', DB::raw('sum(quantity) as quantity'))
            ->groupBy('detail_import_store_id')
            ->get();
    }
}
