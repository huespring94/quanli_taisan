<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\StuffRepository;
use App\Repositories\ImportStoreRepository;
use App\Repositories\DetailImportStoreRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;

class ImportStuffService extends BaseService
{
    /**
     * Stuff repository
     *
     * @var StuffRepository
     */
    protected $stuffRepo;

    /**
     * Import store repository
     *
     * @var ImportStoreRepository
     */
    protected $importStoreRepo;

    /**
     * Detail import store repository
     *
     * @var DetailImportStoreRepository
     */
    protected $detailImportStoreRepo;

    /**
     * Store faculty repository
     *
     * @var StoreFacultyRepository
     */
    protected $storeFacultyRepository;

    /**
     * Store room repository
     *
     * @var StoreRoomRepository
     */
    protected $storeRoomRepository;

    /**
     * Constructor of import stuff service
     *
     * @param StuffRepository             $stuffRepo              []
     * @param ImportStoreRepository       $importStoreRepo        []
     * @param DetailImportStoreRepository $detailImportStoreRepo  []
     * @param StoreFacultyRepository      $storeFacultyRepository []
     * @param StoreRoomRepository         $storeRoomRepository    []
     */
    public function __construct(
        StuffRepository $stuffRepo,
        ImportStoreRepository $importStoreRepo,
        DetailImportStoreRepository $detailImportStoreRepo,
        StoreFacultyRepository $storeFacultyRepository,
        StoreRoomRepository $storeRoomRepository
    ) {
    
        $this->stuffRepo = $stuffRepo;
        $this->importStoreRepo = $importStoreRepo;
        $this->detailImportStoreRepo = $detailImportStoreRepo;
        $this->storeFacultyRepository = $storeFacultyRepository;
        $this->storeRoomRepository = $storeRoomRepository;
    }
    
    /**
     * Get all import store
     *
     * @return array
     */
    public function getAllImportStore()
    {
        return $this->importStoreRepo->all();
    }
    
    /**
     * Create import store
     *
     * @param Request $data []
     *
     * @return object
     */
    public function createImportStore($data)
    {
        $importStore = $this->importStoreRepo
            ->findWhere(['store_id' => $data->store_id, 'date_import' => $data->date_import], ['store_id', 'date_import'])->first();
        if ($importStore) {
            return $importStore;
        }
        $data['user_id'] = auth('web')->user()->id;
        return $this->importStoreRepo->create($data);
    }
    
    
    public function createDetailImportStore($data)
    {
        
    }
}
