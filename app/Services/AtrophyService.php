<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\ImportStoreRepository;
use App\Repositories\DetailImportStoreRepository;
use App\Repositories\AtrophyRepository;
//use App\Repositories\LiquidationRepository;
use App\Services\LiquidationService;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;

class AtrophyService
{
    private $detailIStoreRepo;
    
    private $atrophyRepo;
    
    private $importStoreRepo;
    
    private $liquidationService;
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
   
    /**
     * Constructor for atrophy service
     *
     * @param ImportStoreRepository       $importStoreRepo    []
     * @param DetailImportStoreRepository $detailIStoreRepo   []
     * @param AtrophyRepository           $atrophyRepo        []
     * @param LiquidationService          $liquidationService []
     * @param StoreFacultyRepository      $storeFacultyRepo   []
     * @param StoreRoomRepository         $storeRoomRepo      []
     */
    public function __construct(
        ImportStoreRepository $importStoreRepo,
        DetailImportStoreRepository $detailIStoreRepo,
        AtrophyRepository $atrophyRepo,
        LiquidationService $liquidationService,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo
    ) {
        $this->importStoreRepo = $importStoreRepo;
        $this->detailIStoreRepo = $detailIStoreRepo;
        $this->atrophyRepo = $atrophyRepo;
        $this->liquidationService = $liquidationService;
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
    }
    
    /**
     * Update status stuff
     *
     * @return void
     */
    public function updateStatusStuff()
    {
        $importStores = $this->importStoreRepo
            ->with(['detailImportStores', 'detailImportStores.stuff.atrophy'])
            ->findWhere([['date_import', '<', Carbon::now()->subYear()->format(config('define.date_format'))]]);
        foreach ($importStores as $importStore) {
            $lenghtDays = Carbon::now()->diffInDays(Carbon::parse($importStore->date_import));
            $numYears = $lenghtDays / 365;
            if ($numYears > 0) {
                foreach ($importStore->detailImportStores as $detail) {
                    $rateDown = round($numYears) * $detail->stuff->atrophy->atrophy_rate;
                    $detail->status = $detail->status_start - $rateDown;
                    $detail->save();
                }
            }
        }
    }
    
    /**
     * Update quantity store
     *
     * @param DetailImportStore $detail []
     *
     * @return void
     */
    public function updateQuantityStore($detail)
    {
        $this->storeFacultyRepo->update(['quantity' => 0], $detail->id);
        $this->storeFacultyRepo->deleteWhere(['detail_import_store_id' => $detail->id]);
//        $this->storeFacultyRepo->whereHas('', $closure)
    }
    
    
    /**
     * Get all atrophy
     *
     * @return array
     */
    public function getAllAtrophies()
    {
        return $this->atrophyRepo->all()->orderBy('created_at', 'desc');
    }
}
