<?php

namespace App\Services;

use Carbon\Carbon;
use App\Services\BaseService;
use App\Repositories\LiquidationRepository;
use App\Repositories\DetailImportStoreRepository;

class LiquidationService extends BaseService
{
    /**
     * Liquidation repository
     *
     * @var LiquidationRepository
     */
    private $liquidationRepo;
    
    private $detailIStoreRepo;

    /**
     * Constructor of liquidation service
     *
     * @param LiquidationRepository       $liquidationRepo  []
     * @param DetailImportStoreRepository $detailIStoreRepo []
     */
    public function __construct(
        LiquidationRepository $liquidationRepo,
        DetailImportStoreRepository $detailIStoreRepo
    ) {
        $this->liquidationRepo = $liquidationRepo;
        $this->detailIStoreRepo = $detailIStoreRepo;
    }
    
    /**
     * Get all liquidations
     *
     * @return array
     */
    public function getAllLiquidation()
    {
        return $this->liquidationRepo->with([
                    'detailImportStore.stuff',
                    'detailImportStore.importStore'
                ])
                ->orderBy('created_at', 'desc')
                ->all();
    }

    /**
     * Remove stuff to liquordation
     *
     * @param any $detailId Id of detailImportStore
     *
     * @return void
     */
    public function removeToLiquordation($detailId)
    {
        $detail = $this->detailIStoreRepo->find($detailId);
        if ($detail->status < config('constant.rate_deadline')) {
            $datas = [
                'quantity' => $detail->quantity,
                'detail_import_store_id' => $detail->id,
                'date_liquidation' => Carbon::now()->format(config('define.date_format'))
            ];
            $detail->delete();
            $this->liquidationRepo->create($datas);
        }
    }
}
