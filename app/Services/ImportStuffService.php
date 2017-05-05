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
use App\Models\StoreFaculty;

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
        $data['quantity_start'] = $data['quantity'];
        $data['status_start'] = $data['status'];
        $conditions = [
            'status' => $data['status'],
            'price_unit' => $data['price_unit'],
            'stuff_id' => $data['stuff_id'],
            'import_store_id' => $data['import_store_id']
        ];
        $this->detailImStoreRepo->deleteOrCreate($conditions, $data);
        return $this->detailImStoreRepo->with(['stuff.supplier'])->findByField('import_store_id', $data['import_store_id']);
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
        $data['quantity_start'] = $data['quantity'];
        $data['status_start'] = $data['status'];
        $this->detailImStoreRepo->update($data, $id);
        return $this->detailImStoreRepo->with(['stuff.supplier'])->findByField('import_store_id', $data['import_store_id']);
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
     * Get stuff by stuff id
     *
     * @param int $id Stuff id
     *
     * @return object
     */
    public function getStuffById($id)
    {
        return $this->stuffRepo->with(['kindStuff', 'supplier', 'atrophy'])->findByField('stuff_id', $id)->first();
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
        return $this->detailImStoreRepo->with('stuff.supplier')->findWhere([['quantity', '>', '0']]);
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
        if ($quantityAll < $data['quantity']) {
            return;
        }
        $conditions = [
            'faculty_id' => $data['faculty_id'],
            'date_import' => Carbon::now()->format(config('define.date_format')),
            'stuff_id' => $data['stuff_id']
        ];
        $this->prepareCreateImportFaculty($conditions);
        $importFaculty = $detailImport = [];
        $amount = 0;
        $quantity = $data['quantity'];
        $details = $this->detailImStoreRepo->with(['importStore', 'stuff.supplier'])->findWhere([['quantity', '>', '0'], ['stuff_id', '=', $data['stuff_id']]]);
        foreach ($details as $key => $detail) {
            $remain = $detail->quantity - $quantity;
            if ($quantity == 0) {
                break;
            }
            $arr = [
                'date_import' => Carbon::now()->format(config('define.date_format')),
                'detail_import_store_id' => $detail->id
            ];
            $data = array_merge($data, $arr);
            if ($remain >= 0) {
                $data['quantity'] = $quantity;
                $quantity = 0;
            } else {
                $data['quantity'] = $detail->quantity;
                $quantity = abs($remain);
            }
            $data['quantity_start'] = $data['quantity'];
            $importFaculty[$key] = $this->storeFacultyRepo->deleteOrCreate($conditions, $data);
            $detail->quantity -= $data['quantity'];
            $detail->save();
            $detailImport[] = $detail;
            $importFaculty[$key]->store_faculty_id = $importFaculty[$key]->id . '-' . $data['faculty_id'];
            $importFaculty[$key]->save();
            $amount += $detail->price_unit * $data['quantity'];
        }
        return [
            'import_faculty' => $importFaculty,
            'detail' => $detailImport,
            'amount' => $amount
        ];
    }
    
    /**
     * Get detail import store by import store id
     *
     * @param any $id []
     *
     * @return array
     */
    public function getDetailImportStoreByIStoreId($id)
    {
        return $this->detailImStoreRepo->findByField('import_store_id', $id);
    }
    
    /**
     * Get detail import store by id
     *
     * @param any $id []
     *
     * @return object
     */
    public function getDetailImportStoreById($id)
    {
        return $this->detailImStoreRepo->find($id);
    }
    
    /**
     * Delete detail import store
     *
     * @param any $id []
     *
     * @return object
     */
    public function deleteDetailImportStore($id)
    {
        $detail = $this->detailImStoreRepo->find($id);
        $this->detailImStoreRepo->delete($id);
        $count = $this->importStoreRepo->withCount('detailImportStores')
                ->find($detail->import_store_id)->detail_import_stores_count;
        if ($count == 0) {
            $this->importStoreRepo->delete($detail->import_store_id);
            return;
        }
        return $detail;
    }
    
    /**
     * Delete import store
     *
     * @param any $id []
     *
     * @return void
     */
    public function deleteImportStore($id)
    {
        $this->importStoreRepo->delete($id);
    }
    
    /**
     * Prepare by the way delete import faculty if have before insert
     *
     * @param array $attributes []
     *
     * @return boolean
     */
    public function prepareCreateImportFaculty($attributes)
    {
        $imports = $this->storeFacultyRepo->findWhere([
            'stuff_id' => $attributes['stuff_id'],
            'faculty_id' => $attributes['faculty_id'],
            'date_import' => $attributes['date_import']
        ]);
        if (!empty($imports)) {
            foreach ($imports as $import) {
                $detail = $this->detailImStoreRepo->find($import->detail_import_store_id);
                $detail->quantity += $import->quantity;
                $detail->save();
                if (!$import->has('storeRooms')) {
                    $import->forceDelete();
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * Get all store faculties, with trashed
     *
     * @return mixed
     */
    public function getAllImportFaculty()
    {
        return StoreFaculty::with(['stuff.supplier', 'stuff.kindStuff', 'faculty', 'detailImportStore'])
            ->withTrashed()->get();
    }
    
    /**
     * Get store faculties by faculty id
     *
     * @param any $id []
     *
     * @return mixed
     */
    public function getImportFacultyByFaculty($id)
    {
        if ($id != null) {
            return StoreFaculty::with(['stuff.supplier', 'stuff.kindStuff', 'faculty', 'detailImportStore'])
                    ->where('faculty_id', '=', $id)
                    ->withTrashed()->get();
        }
        return $this->getAllImportFaculty();
    }
    
    /**
     * Delete import stỏe which empty detail import
     *
     * @return void
     */
    public function deleteEmptyImportStore()
    {
        $importStores = $this->importStoreRepo
            ->findWhere([['created_at', '<', Carbon::now()->subDay()->format(config('define.timestamp_format'))]]);
        foreach ($importStores as $importStore) {
            if (count($this->detailImStoreRepo->findByField('import_store_id', $importStore->id)) == 0) {
                $importStore->delete();
            }
        }
    }
}
