<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\StoreFacultyRepository;
use App\Models\StoreFaculty;
use App\Repositories\StoreRoomRepository;
use App\Repositories\RoomRepository;
use App\Services\RequestService;
use App\Repositories\DetailImportStoreRepository;

class StuffFacultyService
{
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    private $roomRepo;
    
    private $requestService;
    
    private $detailRepo;

    /**
     * Constructor of stuff faculty service
     *
     * @param StoreFacultyRepository      $storeFacRepo   []
     * @param StoreRoomRepository         $storeRoomRepo  []
     * @param RoomRepository              $roomRepo       []
     * @param RequestService              $requestService []
     * @param DetailImportStoreRepository $detailRepo     []
     */
    public function __construct(
        StoreFacultyRepository $storeFacRepo,
        StoreRoomRepository $storeRoomRepo,
        RoomRepository $roomRepo,
        RequestService $requestService,
        DetailImportStoreRepository $detailRepo
    ) {
        $this->storeFacultyRepo = $storeFacRepo;
        $this->storeRoomRepo = $storeRoomRepo;
        $this->roomRepo = $roomRepo;
        $this->requestService = $requestService;
        $this->detailRepo = $detailRepo;
    }

    /**
     * Get stuff in store faculty by id faculty
     *
     * @param any $facultyId []
     *
     * @return array
     */
    public function getStuffInStoreFacutyByFaculty($facultyId)
    {
        return StoreFaculty::with('stuff.supplier')->where('faculty_id', $facultyId)
            ->whereHas('detailImportStore', function ($has) {
                $has->where('status', '>', config('constant.rate_deadline'));
            })->select('stuff_id')
            ->distinct()->get();
    }
    
    /**
     * Get quantity in store faculty by id stuff
     *
     * @param any $id []
     *
     * @return int
     */
    public function getQuantityByStuffId($id)
    {
        return $this->storeFacultyRepo->getQuantityByFacultyStuffId($id, auth()->user()->faculty_id);
    }
    
    /**
     * Create import store room
     *
     * @param Request $request []
     *
     * @return mixed
     */
    public function createImportStoreRoom($request)
    {
        $user = auth()->user();
        $data = $request->only('room_id', 'stuff_id', 'quantity');
        $quantityAll = $this->storeFacultyRepo->getQuantityByFacultyStuffId($data['stuff_id'], $user->faculty_id);
        if ($quantityAll < $data['quantity']) {
            return;
        }
        $conditions = [
            'room_id' => $data['room_id'],
            'date_import' => Carbon::now()->format(config('define.date_format')),
            'stuff_id' => $data['stuff_id']
        ];
        $this->prepareCreateImportRoom($conditions);
        $importRoom = $storeFaculty = [];
        $amount = 0;
        $quantity = $data['quantity'];
        $storeFaculties = $this->storeFacultyRepo->with('detailImportStore')
            ->whereHas('detailImportStore', function ($has) {
                $has->where('status', '>', config('constant.rate_deadline'));
            })
            ->findWhere([
                ['faculty_id', '=', $user->faculty_id],
                ['quantity', '>', '0'],
                ['stuff_id', '=', $data['stuff_id']]
            ]);
        foreach ($storeFaculties as $key => $detail) {
            $remain = $detail->quantity - $quantity;
            if ($quantity == 0) {
                break;
            }
            $arr = [
                'date_import' => Carbon::now()->format(config('define.date_format')),
                'store_faculty_id' => $detail->store_faculty_id
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
            $importRoom[$key] = $this->storeRoomRepo->create($data);
            $detail->quantity -= $data['quantity'];
            $detail->save();
            $storeFaculty[] = $detail;
            $importRoom[$key]->store_room_id = $importRoom[$key]->id . '-' . $data['room_id'] . '-' . $detail['faculty_id'];
            $importRoom[$key]->save();
            $amount += $detail->detailImportStore->price_unit * $data['quantity'];
        }
        return [
            'import_room' => $importRoom,
            'detail' => $storeFaculty,
            'amount' => $amount
        ];
    }

    /**
     * Prepare by the way delete import faculty if have before insert
     *
     * @param array $attributes []
     *
     * @return boolean
     */
    public function prepareCreateImportRoom($attributes)
    {
        $imports = $this->storeRoomRepo->findWhere([
            'stuff_id' => $attributes['stuff_id'],
            'room_id' => $attributes['room_id'],
            'date_import' => $attributes['date_import']
        ]);
        if (!empty($imports)) {
            foreach ($imports as $import) {
                $detail = $this->storeFacultyRepo->find($import->store_faculty_id);
                $detail->quantity += $import->quantity;
                $detail->save();
                $import->forceDelete();
            }
        }
    }
    
    /**
     * Get stuff by room id
     *
     * @param any $roomId []
     *
     * @return array
     */
    public function getStuffByRoom($roomId)
    {
        return $this->storeRoomRepo->findByField('room_id', $roomId);
    }
    
    /**
     * Get stuff by room id
     *
     * @param any $roomId []
     *
     * @return array
     */
    public function getImportRoomAllByRoom($roomId)
    {
        $requestQs = $this->requestService->getRequestAllLiquidationByRoom($roomId)
            ->pluck('quantity', 'store_type_id')->all();
//        $requestSs = $this->requestService->getRequestAllLiquidationByRoom($roomId)
//            ->pluck('status', 'store_type_id')->all();
        $storeRooms = $this->storeRoomRepo
            ->with(['room', 'storeFaculty.detailImportStore', 'stuff.supplier'])
            ->whereHas('storeFaculty', function ($has) use ($roomId) {
                $has->where('room_id', '=', $roomId);
            })->orderBy('created_at', 'desc')->all();
        foreach ($storeRooms as $storeRoom) {
            if (in_array($storeRoom->store_room_id, array_keys($requestQs))) {
                $storeRoom['liquidation_quantity'] = $requestQs[$storeRoom->store_room_id];
//                $storeRoom['liquidation_status'] = $requestSs[$storeRoom->store_room_id];
            }
        }
        return $storeRooms;
    }
    
    /**
     * Get import room by room id
     *
     * @param any $roomId []
     *
     * @return array
     */
    public function getImportRoomByRoom($roomId)
    {
        $requests = $this->requestService->getRequestLiquidationByRoom($roomId)
            ->pluck('quantity', 'store_type_id')->all();
        $storeRooms = $this->storeRoomRepo->with(['room', 'storeFaculty.detailImportStore', 'stuff.supplier'])
                ->findByField('room_id', $roomId);
        foreach ($storeRooms as $storeRoom) {
            if (in_array($storeRoom->store_room_id, array_keys($requests))) {
                $storeRoom['liquidation'] = $requests[$storeRoom->store_room_id];
            }
        }
        return $storeRooms;
    }
    
    /**
     * Get import room by room id
     *
     * @param any $facultyId []
     *
     * @return array
     */
    public function getImportFacultyByFaculty($facultyId)
    {
        $requestQs = $this->requestService->getRequestAllLiquidationByFaculty($facultyId)
            ->pluck('quantity', 'store_type_id')->all();
//        $requestSs = $this->requestService->getRequestAllLiquidationByFaculty($facultyId)
//            ->pluck('status', 'store_type_id')->all();
        $storeFaculties = StoreFaculty::with(['stuff.supplier', 'detailImportStore'])
            ->where('faculty_id', '=', $facultyId)
            ->where('quantity', '>', 0)
            ->orderBy('created_at', 'desc')->get();
        foreach ($storeFaculties as $storeFaculty) {
            if (in_array($storeFaculty->store_faculty_id, array_keys($requestQs))) {
                $storeFaculty['liquidation_quantity'] = $requestQs[$storeFaculty->store_faculty_id];
//                $storeFaculty['liquidation_status'] = $requestSs[$storeFaculty->store_faculty_id];
            }
        }
        return $storeFaculties;
    }
    
    /**
     * Get import room by room id
     *
     * @param any $id []
     *
     * @return array
     */
    public function getStoreFacultyByStoreFaculty($id)
    {
        return $this->storeFacultyRepo
            ->with(['stuff.supplier', 'detailImportStore'])
            ->findByField('store_faculty_id', $id)->first();
    }
    
    /**
     * Get import faculty by faculty id and quantity greater zero
     *
     * @param any $facultyId []
     *
     * @return array
     */
    public function getStoreFacultyByFacultyNotZero($facultyId)
    {
        return $this->storeFacultyRepo
            ->findWhere([['faculty_id', '=', $facultyId], ['quantity', '>', 0]]);
    }
    
    /**
     * Get all stuff in store
     *
     * @return mixed
     */
    public function getAllDetail()
    {
        return $this->detailRepo->with(['importStore.store', 'stuff.supplier'])
            ->findWhere([['quantity', '>', 0]])
            ->all();
    }
    
    /**
     * Update quantity for store room
     *
     * @param Request $request []
     *
     * @return boolean
     */
    public function updateStoreRoom($request)
    {
        $data = $request->only('quantity', 'id');
        $storeRoom = $this->storeRoomRepo->find($data['id']);
        $storeFaculty = $this->storeFacultyRepo->findByField('store_faculty_id', $storeRoom->store_faculty_id)->first();
        if ($data['quantity'] > 0 && $data['quantity'] < $storeFaculty->quantity) {
            $storeFaculty->quantity += ($storeRoom->quantity - $data['quantity']);
            $storeFaculty->save();
            $storeRoom->quantity = $data['quantity'];
            $storeRoom->save();
            return true;
        }
        return false;
    }
    
    /**
     * Delete store room
     *
     * @param any $id []
     *
     * @return void
     */
    public function deleteStoreRoom($id)
    {
        $storeRoom = $this->storeRoomRepo->find($id);
        $storeFaculty = $this->storeFacultyRepo->findByField('store_faculty_id', $storeRoom->store_faculty_id)->first();
        $storeFaculty->quantity += $storeRoom->quantity;
        $storeFaculty->save();
        $storeRoom->forceDelete();
    }
}
