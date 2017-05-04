<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\StoreFacultyRepository;
use App\Models\StoreFaculty;
use App\Repositories\StoreRoomRepository;

class StuffFacultyService
{
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    /**
     * Constructor of stuff faculty service
     *
     * @param StoreFacultyRepository $storeFacRepo []
     */
    public function __construct(StoreFacultyRepository $storeFacRepo,
        StoreRoomRepository $storeRoomRepo)
    {
        $this->storeFacultyRepo = $storeFacRepo;
        $this->storeRoomRepo = $storeRoomRepo;
    }

    /**
     * Get stuff in store faculty by id faculty
     *
     * @param any $facultyId
     *
     * @return array
     */
    public function getStuffInStoreFacutyByFaculty($facultyId)
    {
        return StoreFaculty::with('stuff')->where('faculty_id', $facultyId)->select('stuff_id')
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
        $storeFaculties = $this->storeFacultyRepo->findWhere([['faculty_id', '=', $user->faculty_id], ['quantity', '>', '0'], ['stuff_id', '=', $data['stuff_id']]]);
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
            $amount += $detail->price_unit * $data['quantity'];
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
}