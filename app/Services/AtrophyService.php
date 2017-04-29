<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\ImportStoreRepository;
use App\Repositories\DetailImportStoreRepository;
use App\Repositories\AtrophyRepository;
use App\Repositories\LiquidationRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;

class AtrophyService extends BaseService
{
    
    private $detailIStoreRepo;
    
    private $atrophyRepo;
    
    private $importStoreRepo;
    
    private $liquidationRepo;
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;

    /**
     * Constructor for atrophy service
     *
     * @param DetailImportStoreRepository $detailImportStoreRepo []
     * @param AtrophyRepository           $atrophyRepo           []
     */
    public function __construct(
        ImportStoreRepository $importStoreRepo,
        DetailImportStoreRepository $detailIStoreRepo, 
        AtrophyRepository $atrophyRepo,
        LiquidationRepository $liquidationRepo,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo)
    {
        $this->importStoreRepo = $importStoreRepo;
        $this->$detailIStoreRepo = $detailIStoreRepo;
        $this->atrophyRepo = $atrophyRepo;
        $this->liquidationRepo = $liquidationRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
    }
    
    public function updateStatusStuff()
    {
        $importStores = $this->importStoreRepo
            ->with(['detailImportStores', 'detailImportStores.stuff.atrophy'])
            ->findWhere([['date_import', '<', Carbon::now()->subYear()->format(config('define.date_format'))]]);
        foreach ($importStores as $importStore) {
            $lenghtDays = Carbon::now()->diffInDays(Carbon::parse($importStore->date_import));
            $numYears = $lenghtDays / 365;
            if ($numYears > 0) {
                \Log::debug('$numYears');
                foreach ($importStore->detailImportStores as $detail) {
                    $rateDown = round($numYears) * $detail->stuff->atrophy->atrophy_rate;
                    $detail->status = $detail->status_start - $rateDown;
                    $detail->save();
                }
            }
        }
    }
    
    public function removeToLiquordation($detail)
    {
        if ($detail->status < config('constant.rate_deadline')) {
           $detail->delete();
           $datas = [
                'quantity' => $detail->quantity_start,
                'detail_import_store_id' => $detail->id,
                'date_liquidation' => Carbon::now()->format(config('define.date_format'))
           ];
           $this->liquidationRepo->create($datas);
        }
    }
    
    public function updateQuantityStoreFacultyAndRoom($detail)
    {
        $this->storeFacultyRepo->update(['quantity' => 0], $detail->id);
        $this->storeFacultyRepo->deleteWhere(['detail_import_store_id' => $detail->id]);
//        $this->storeFacultyRepo->whereHas('', $closure)
    }
}
