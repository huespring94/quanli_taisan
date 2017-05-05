<?php

namespace App\Services;

use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;
use App\Repositories\DetailImportStoreRepository;

class HistoryImportService
{
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    private $detailIStoreRepo;
    
    /**
     * Constructor of history import service
     *
     * @param StoreFacultyRepository      $storeFacultyRepo []
     * @param StoreRoomRepository         $storeRoomRepo    []
     * @param DetailImportStoreRepository $detailIStoreRepo []
     */
    public function __construct(
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo,
        DetailImportStoreRepository $detailIStoreRepo
    ) {
    
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
        $this->detailIStoreRepo = $detailIStoreRepo;
    }
    
    /**
     * Get store room by id store faculty
     *
     * @param any $storeFacId []
     *
     * @return array
     */
    public function getStoreRoomByStoreFaculty($storeFacId)
    {
        return $this->storeRoomRepo
            ->with(['stuff', 'storeFaculty.detailImportStore'])
            ->findByField('store_faculty_id', $storeFacId);
    }
}
