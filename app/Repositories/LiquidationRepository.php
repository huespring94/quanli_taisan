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
                    'detailImportStore.importStore.store',
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
                    'detailImportStore.importStore',
                    'storeFaculty.stuff', 'storeFaculty.detailImportStore',
                    'storeRoom.stuff', 'storeRoom.storeFaculty.detailImportStore'
                ])
            ->select('detail_import_store_id', DB::raw('sum(quantity) as quantity'))
            ->groupBy('detail_import_store_id')
            ->get();
    }
    
    /**
     * Get store faculty by year and faculty group by stuff
     *
     * @return mixed
     */
    public function getLiquidationByYear()
    {
        return Liquidation::with([
                    'detailImportStore.importStore',
                    'storeFaculty.stuff', 'storeFaculty.detailImportStore',
                    'storeRoom.stuff', 'storeRoom.storeFaculty.detailImportStore'
                ])
            ->select('store_liquidation_id', DB::raw('sum(quantity) as quantity'))
            ->groupBy('store_liquidation_id')
            ->get();
    }
}
