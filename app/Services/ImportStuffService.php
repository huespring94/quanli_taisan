<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\StuffRepository;
use App\Repositories\ImportStoreRepository;
use App\Repositories\DetailImportStoreRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;
use App\Http\Requests\PostImportStoreRequest;

class ImportStuffService extends BaseService
{
    /**
     * Stuff repository
     * 
     * @var StuffRepository
     */
    private $stuffRepo;
    
    /**
     * Import store repository
     * 
     * @var ImportStoreRepository
     */
    private $importStoreRepo;
    
    /**
     * Detail import store repository
     * 
     * @var DetailImportStoreRepository
     */
    private $detailImportStoreRepo;

    /**
     * Store faculty repository
     * 
     * @var StoreFacultyRepository
     */
    private $storeFacultyRepository;
    
    /**
     * Store room repository
     * 
     * @var StoreRoomRepository
     */
    private $storeRoomRepository;
    
    /**
     * Constructor of import stuff service
     * 
     * @param StuffRepository $stuffRepo
     * @param ImportStoreRepository $importStoreRepo
     * @param DetailImportStoreRepository $detailImportStoreRepo
     * @param StoreFacultyRepository $storeFacultyRepository
     * @param StoreRoomRepository $storeRoomRepository
     */
    public function _contruct(
        StuffRepository $stuffRepo,
        ImportStoreRepository $importStoreRepo,
        DetailImportStoreRepository $detailImportStoreRepo,
        StoreFacultyRepository $storeFacultyRepository,
        StoreRoomRepository $storeRoomRepository)
    {
        $this->stuffRepo = $stuffRepo;
        $this->importStoreRepo = $importStoreRepo;
        $this->detailImportStoreRepo = $detailImportStoreRepo;
        $this->storeFacultyRepository = $storeFacultyRepository;
        $this->storeRoomRepository = $storeRoomRepository;
    }

    /**
     * 
     * @param type $data
     * 
     * @return type
     */
    public function createImportStore()
    {
        $abc = $this->importStoreRepo->findByField('date_import', '2017-10-10 00:00:00')->first();
        
        return $abc;
//        if($importStore = $this->importStoreRepo->first(1)) {
//            return $importStore;
//        }
//        return $this->importStoreRepo->create($data);
    }
    
    /**
     * Get all data in table import_store
     * 
     * @return array
     */
    public function getAllImportStore()
    {
        return \App\Models\User::all();
    }
    
    
}
