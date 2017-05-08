<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\StoreFacultyRepository;
use App\Models\StoreFaculty;
use App\Repositories\StoreRoomRepository;
use App\Models\Room;
use App\Repositories\RoomRepository;
use App\Services\RequestService;

class StuffFacultyService
{
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    private $roomRepo;
    
    private $requestService;

    /**
     * Constructor of stuff faculty service
     *
     * @param StoreFacultyRepository $storeFacRepo  []
     * @param StoreRoomRepository    $storeRoomRepo []
     * @param RoomRepository         $roomRepo      []
     */
    public function __construct(
        StoreFacultyRepository $storeFacRepo,
        StoreRoomRepository $storeRoomRepo,
        RoomRepository $roomRepo,
        RequestService $requestService
    ) {
        $this->storeFacultyRepo = $storeFacRepo;
        $this->storeRoomRepo = $storeRoomRepo;
        $this->roomRepo = $roomRepo;
        $this->requestService = $requestService;
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
        return StoreFaculty::with('stuff.supplier')->where('faculty_id', $facultyId)->select('stuff_id')
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
        $requestSs = $this->requestService->getRequestAllLiquidationByRoom($roomId)
            ->pluck('status', 'store_type_id')->all();
        $storeRooms = $this->storeRoomRepo
            ->with(['room', 'storeFaculty.detailImportStore', 'stuff.supplier'])
            ->whereHas('storeFaculty', function($has) use ($roomId) {
                $has->where('room_id', '=', $roomId);
            })->all();
        foreach ($storeRooms as $storeRoom) {
            if (in_array($storeRoom->store_room_id, array_keys($requestQs))) {
                $storeRoom['liquidation_quantity'] = $requestQs[$storeRoom->store_room_id];
                $storeRoom['liquidation_status'] = $requestSs[$storeRoom->store_room_id];
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
     * @return array
     */
    public function getImportFacultyByFaculty()
    {
        $user = auth()->user();
        $requests = $this->requestService->getRequestLiquidationByFaculty($user->faculty_id)
            ->pluck('quantity', 'store_type_id')->all();
        $storeFaculties = StoreFaculty::with(['stuff.supplier', 'detailImportStore'])
            ->where('faculty_id', '=', $user->faculty_id)->get();
        foreach ($storeFaculties as $storeFaculty) {
            if (in_array($storeFaculty->store_faculty_id, array_keys($requests))) {
                $storeFaculty['liquidation'] = $requests[$storeFaculty->store_faculty_id];
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
}
