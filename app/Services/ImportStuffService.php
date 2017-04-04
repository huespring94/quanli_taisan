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
     * @param Request $request []
     *
     * @return object
     */
    public function createImportStore($request)
    {
        $data = $request->only('store_id', 'date_import');
        $user = auth('web')->user();
        $importStore = $this->importStoreRepo
            ->findWhere(
                ['store_id' => $data['store_id'], 
                'date_import' => $data['date_import'],
                'user_id' => $user->id])->first();
        if ($importStore) {
            $result = $importStore;
        }
        $data['user_id'] = $user->id;
        $result = $this->importStoreRepo->create($data);
        return $this->importStoreRepo->with(['store', 'user'])->find($result->id);
    }
    
    /**
     * Create detail import store 
     *
     * @param Request $request []
     *
     * @return object
     */
    public function createDetailImportStore($request)
    {
        $data = $request->only('quantity', 'price_unit', 'status', 'stuff_id', 'import_store_id');
        $this->detailImportStoreRepo->create($data);
        $amount = $data['price_unit'] * $data['quantity'];
        $this->importStoreRepo->update(['amount' => $amount], $data['import_store_id']);
        return $this->importStoreRepo->with('detail_import_store')->find($data['import_store_id']);
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
     * Get all of stuffs
     * 
     * @return array
     */
    public function getAllStuff()
    {
        return $this->stuffRepo->all();
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
