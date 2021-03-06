<?php

namespace App\Services;

use Carbon\Carbon;
use App\Services\BaseService;
use App\Repositories\LiquidationRepository;
use App\Repositories\DetailImportStoreRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;
use App\Repositories\RequestRepository;
use App\Services\FacultyRoomService;

class LiquidationService extends BaseService
{
    /**
     * Liquidation repository
     *
     * @var LiquidationRepository
     */
    private $liquidationRepo;
    
    private $detailIStoreRepo;
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    private $requestRepo;
    
    private $facRoomService;

    /**
     * Constructor of liquidation service
     *
     * @param LiquidationRepository       $liquidationRepo  []
     * @param DetailImportStoreRepository $detailIStoreRepo []
     * @param StoreFacultyRepository      $storeFacultyRepo []
     * @param StoreRoomRepository         $storeRoomRepo    []
     * @param RequestRepository           $requestRepo      []
     * @param FacultyRoomService          $facRoomService   []
     */
    public function __construct(
        LiquidationRepository $liquidationRepo,
        DetailImportStoreRepository $detailIStoreRepo,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo,
        RequestRepository $requestRepo,
        FacultyRoomService $facRoomService
    ) {
        $this->liquidationRepo = $liquidationRepo;
        $this->detailIStoreRepo = $detailIStoreRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
        $this->requestRepo = $requestRepo;
        $this->facRoomService = $facRoomService;
    }
    
    /**
     * Get all liquidations for store
     *
     * @return array
     */
    public function getAllLiquidation()
    {
        return $this->liquidationRepo->getAllLiquidation();
    }
    
    /**
     * Get all liquidations for store
     *
     * @return array
     */
    public function getAllLiquidationShort()
    {
        return $this->liquidationRepo->getAllLiquidationShort();
    }
    
    /**
     * Get all liquidations for faculty
     *
     * @return array
     */
    public function getAllLiquidationFaculty()
    {
        $facultyId = auth()->user()->faculty_id;
        return $this->storeFacultyRepo->getLiquidation($facultyId);
    }
    
    /**
     * Get all liquidations for room
     *
     * @return array
     */
    public function getAllLiquidationRoom()
    {
        $room = $this->facRoomService->getRoomByUser(auth()->user()->id);
        return $this->storeFacultyRepo->getLiquidationByRoom($room->room_id);
    }

    /**
     * Remove stuff to liquordation
     *
     * @param any $detailId Id of detailImportStore
     *
     * @return void
     */
    public function removeToLiquidation($detailId)
    {
        $detail = $this->detailIStoreRepo->find($detailId);
        $datas = [
            'date_liquidation' => Carbon::now()->format(config('define.date_format')),
            'quantity' => $detail->quantity,
            'store_liquidation_id' => $detail->id,
            'store_type' => config('constant.type_school'),
        ];
        if ($detail->quantity_start == $detail->quantity) {
            $detail->delete();
        } else {
            $detail->quantity = 0;
            $detail->save();
        }
        $this->liquidationRepo->create($datas);
    }

    /**
     * Remove stuff to liquordation and delete in store faculty
     *
     * @param any $storeFacultyId Id of store faculty id
     *
     * @return void
     */
    public function removeToLiquordationFaculty($storeFacultyId)
    {
        $storeFaculty = $this->storeFacultyRepo->find($storeFacultyId);
        $datas = [
            'quantity' => $storeFaculty->quantity,
            'detail_import_store_id' => $storeFaculty->detail_import_store_id,
            'date_liquidation' => Carbon::now()->format(config('define.date_format'))
        ];
        $storeFaculty->delete();
        $this->liquidationRepo->create($datas);
    }
    
    /**
     * Remove stuff to liquordation and delete in store room
     *
     * @param any $storeRoomId Id of store room id
     *
     * @return void
     */
    public function removeToLiquordationRoom($storeRoomId)
    {
        $storeRoom = $this->storeRoomRepo->find($storeRoomId);
        $datas = [
            'quantity' => $storeRoom->quantity,
            'detail_import_store_id' => $storeRoom->detail_import_store_id,
            'date_liquidation' => Carbon::now()->format(config('define.date_format'))
        ];
        $storeRoom->delete();
        $this->liquidationRepo->create($datas);
    }
    
    /**
     * Create liquidation by request
     *
     * @param type $requestId []
     *
     * @return void
     */
    public function createLiquidationByRequest($requestId)
    {
        $request = $this->requestRepo->find($requestId);
        $datas = [
            'date_liquidation' => Carbon::now()->format(config('define.date_format')),
            'quantity' => $request->quantity,
            'store_liquidation_id' => $request->store_type_id,
            'store_type' => $request->type,
        ];
        $this->liquidationRepo->create($datas);
    }
}
