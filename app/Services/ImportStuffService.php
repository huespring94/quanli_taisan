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
        $array = [
            'store_id' => $data['store_id'], 
            'date_import' => $data['date_import'],
            'user_id' => $user->id
            ];
        $condition = array_only($array, ['store_id', 'date_import', 'user_id']);
        return $this->importStoreRepo->updateOrCreate($condition, $array);
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
        $conditions = [
            'status' => $data['status'],
            'price_unit' => $data['price_unit'],
            'stuff_id' => $data['stuff_id'],
            'import_store_id' => $data['import_store_id']
        ];
        $this->detailImportStoreRepo->updateOrCreateQuantity($conditions, $data, 'quantity');
        return $this->detailImportStoreRepo->with(['stuff'])->findByField('import_store_id', $data['import_store_id']);
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
    public function getAllKindStuff()
    {
        return $this->kindStuffRepo->all();
    }
    
    /**
     * Get all of kind of stuffs
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
    
    /**
     * Get stuff by id kind of stuff
     * 
     * @param int $kindStuffId Id of kind of stuff
     *
     * @return object
     */
    public function getStuffByIdKindStuff($kindStuffId)
    {
        return $this->stuffRepo->findByField('kind_stuff_id', $kindStuffId);
    }
    
    /**
     * Get import store with user and stor by id import store
     *
     * @param mixed $id Id of import store
     *
     * @return mixed
     */
    public function getImportStoreUserStore($id)
    {
        return $this->importStoreRepo->with(['store', 'user'])->find($id);
    }
    
    /**
     * Get import store by id import store
     *
     * @param mixed $id Id of import store
     *
     * @return object
     */
    public function getImportStoreById($id)
    {
        return $this->importStoreRepo->find($id);
    }

    /**
     * Calculate amount by id of import store 
     *
     * @param mixed $id Id of import store
     *
     * @return int
     */
    public function countAmountImportStore($id)
    {
        $detailImports = $this->detailImportStoreRepo->findByField('import_store_id', $id);
        $result = 0;
        foreach ($detailImports as $detail){
            $result += ($detail->quantity * $detail->price_unit);
        }
        return $result;
    }

    /**
     * Get detail store with stuff which has quantity greater than zero
     *
     * @return mixed
     */
    public function getDetailStoreVsStuffNotZero()
    {
        return $this->detailImportStoreRepo->with('stuff')->findWhere([['quantity', '>', '0']]);
    }
    
    public function getDetailStoreByStuffId($id)
    {
        return $this->detailImportStoreRepo->findByField('stuff_id', $id);
    }

    public function getAllImportFaculty()
    {
        return $this->storeFacultyRepository->all();
    }

    public function getImportFacultyByImportedUser($userId)
    {
        return $this->storeFacultyRepository->findByField('user_id', $userId);
    }
    
    public function createImportFaculty($data)
    {
        
    }
}
