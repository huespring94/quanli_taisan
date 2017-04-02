<?php

namespace App\Services;

use Carbon\Carbon;
use App\Services\BaseService;
use App\Repositories\KindStuffRepository;
use App\Repositories\StuffRepository;
use App\Repositories\ImportStoreRepository;
use App\Repositories\DetailImportStoreRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;
use App\Repositories\SupplierRepository;

class ImportStuffService extends BaseService
{
    /**
     * Kind of stuff
     * 
     * @var KindStuff 
     */
    protected $kindStuffRepo;
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
     * Supplier repository
     *
     * @var SupplierRepository
     */
    protected $supplierRepository;
    
    /**
     * Constructor of import stuff service
     *
     * @param KindStuffRepository         $kindStuffRepo          []
     * @param StuffRepository             $stuffRepo              []
     * @param ImportStoreRepository       $importStoreRepo        []
     * @param DetailImportStoreRepository $detailImportStoreRepo  []
     * @param StoreFacultyRepository      $storeFacultyRepository []
     * @param StoreRoomRepository         $storeRoomRepository    []
     * @param SupplierRepository          $supplierRepository     []
     */
    public function __construct(
        KindStuffRepository $kindStuffRepo,
        StuffRepository $stuffRepo,
        ImportStoreRepository $importStoreRepo,
        DetailImportStoreRepository $detailImportStoreRepo,
        StoreFacultyRepository $storeFacultyRepository,
        StoreRoomRepository $storeRoomRepository,
        SupplierRepository $supplierRepository)
    {
        $this->kindStuffRepo = $kindStuffRepo;
        $this->stuffRepo = $stuffRepo;
        $this->importStoreRepo = $importStoreRepo;
        $this->detailImportStoreRepo = $detailImportStoreRepo;
        $this->storeFacultyRepository = $storeFacultyRepository;
        $this->storeRoomRepository = $storeRoomRepository;
        $this->supplierRepository = $supplierRepository;
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
    public function createImportStore($dd)
    {
        $data = $dd->only('store_id', 'date_import');
        $importStore = $this->importStoreRepo
            ->findWhere(['store_id' => $data['store_id'], 'date_import' => $data['date_import']], ['store_id', 'date_import'])->first();
        if ($importStore) {
            return $importStore;
        }
        $data['user_id'] = auth('web')->user()->id;
        return $this->importStoreRepo->create($data);
    }
    
    /**
     * Create detail import store 
     *
     * @param Request $data []
     *
     * @return object
     */
    public function createDetailImportStore($data)
    {
        return $this->detailImportStoreRepo->create($data);
    }
    
    /**
     * Create stuff
     *
     * @param Request $data []
     *
     * @return object
     */
    public function createStuff($data)
    {
        return $this->stuffRepo->create($data);
    }
    
    /**
     * Create kind of stuff
     * 
     * @param Request $data []
     *
     * @return object
     */
    public function createKindStuff($data)
    {
        return $this->kindStuffRepo->create($data);
    }
}
