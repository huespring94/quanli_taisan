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
use Session;

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
    protected $detailImStoreRepo;

    /**
     * Store faculty repository
     *
     * @var StoreFacultyRepository
     */
    protected $storeFacultyRepo;

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
     * @param KindStuffRepository         $kindStuffRepo       []
     * @param StuffRepository             $stuffRepo           []
     * @param ImportStoreRepository       $importStoreRepo     []
     * @param DetailImportStoreRepository $detailImStoreRepo   []
     * @param StoreFacultyRepository      $storeFacultyRepo    []
     * @param StoreRoomRepository         $storeRoomRepository []
     * @param SupplierRepository          $supplierRepository  []
     */
    public function __construct(
        KindStuffRepository $kindStuffRepo,
        StuffRepository $stuffRepo,
        ImportStoreRepository $importStoreRepo,
        DetailImportStoreRepository $detailImStoreRepo,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepository,
        SupplierRepository $supplierRepository
    ) {
    
        $this->kindStuffRepo = $kindStuffRepo;
        $this->stuffRepo = $stuffRepo;
        $this->importStoreRepo = $importStoreRepo;
        $this->detailImStoreRepo = $detailImStoreRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
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
        $this->detailImStoreRepo->deleteOrCreate($conditions, $data);
        return $this->detailImStoreRepo->with(['stuff'])->findByField('import_store_id', $data['import_store_id']);
    }
    
    /**
     * Update detail import store
     *
     * @param Request $request []
     * @param any     $id      []
     *
     * @return object
     */
    public function updateDetailImportStore($request, $id)
    {
        $data = $request->only('quantity', 'price_unit', 'status', 'stuff_id', 'import_store_id');
        $this->detailImStoreRepo->update($data, $id);
        return $this->detailImStoreRepo->with(['stuff'])->findByField('import_store_id', $data['import_store_id']);
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
        return $this->detailImStoreRepo->countAmountImportStore($id);
    }

    /**
     * Get detail store with stuff which has quantity greater than zero
     *
     * @return mixed
     */
    public function getDetailStoreVsStuffNotZero()
    {
        return $this->detailImStoreRepo->with('stuff')->findWhere([['quantity', '>', '0']]);
    }

    /**
     * Get quantity by stuff id
     *
     * @param any $id []
     *
     * @return int
     */
    public function getQuantityByStuffId($id)
    {
        return $this->detailImStoreRepo->getQuantityByStuffId($id);
    }

    /**
     * Create import store faculty
     *
     * @param Request $request []
     *
     * @return mixed
     */
    public function createImportFaculty($request)
    {
        $data = $request->only('faculty_id', 'stuff_id', 'quantity');
        $quantityAll = $this->detailImStoreRepo->getQuantityByStuffId($data['stuff_id']);
        $results = [];
        if ($quantityAll >= $data['quantity']) {
            $details = $this->detailImStoreRepo->findWhere([['quantity', '>', '0']]);
            $quantity = $data['quantity'];
            foreach ($details as $key => $detail) {
                $remain = $detail->quantity - $quantity;
                $arr = [
                    'date_import' => $detail->importStore->date_import,
                    'status' => $detail->status,
                    'detail_import_store_id' => $detail->id
                ];
                $data = array_merge($data, $arr);
                $conditions = [
                    'date_import' => $data['date_import'],
                    'detail_import_store_id' => $data['detail_import_store_id'],
                    'faculty_id' => $data['faculty_id']
                ];
                if ($quantity == 0) {
                    break;
                }
                if ($remain >= 0) {
                    $data['quantity'] = $quantity;
                    $quantity = 0;
                } else {
                    $data['quantity'] = $detail->quantity;
                    $quantity = abs($remain);
                }
                $detail->quantity = $remain + $quantity;
                $detail->save();
                $results[$key] = $this->storeFacultyRepo->updateOrCreateQuantity($conditions, $data, 'quantity');
                $results[$key]->store_faculty_id = $results[$key]->id . ' - ' . $data['faculty_id'];
                $results[$key]->save();
            }
        }
        return array_unique($results);
    }
    
    //    public function getDetailStoreByStuffId($id)
//    {
//        return $this->detailImportStoreRepo->findByField('stuff_id', $id);
//    }
//
//    public function getAllImportFaculty()
//    {
//        return $this->storeFacultyRepository->all();
//    }
//
//    public function getImportFacultyByImportedUser($userId)
//    {
//        return $this->storeFacultyRepository->findByField('user_id', $userId);
//    }
    
    public function getDetailImportStoreById($id)
    {
        return $this->detailImStoreRepo->find($id);
    }
    
    public function deleteDetailImportStore($id)
    {
        dd('hello');
        dd($this->importStoreRepo->whereHas('detailImportStores', ['id' => $id]));
        $this->detailImStoreRepo->delete($id);
//        if()
    }
}
