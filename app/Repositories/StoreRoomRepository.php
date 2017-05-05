<?php

namespace App\Repositories;

use App\Models\StoreRoom;
use DB;

class StoreRoomRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return StoreRoom::class;
    }
    
    /**
     * Update status in store faculty
     *
     * @param DetailImportStore $detail []
     *
     * @return void
     */
    public function updateStatus($detail)
    {
        $storeRooms = $this->whereHas('storeFaculty', function ($has) use ($detail) {
            $has->where('detail_import_store_id', '=', $detail->id);
        });
        foreach ($storeRooms as $storeRoom) {
            $this->update(['status' => $detail->status], $storeRoom->id);
        }
    }
    
    /**
     * Update status in store faculty
     *
     * @param StoreFaculty $storeFac []
     *
     * @return void
     */
    public function updateStatusFaculty($storeFac)
    {
        $storeRooms = $this->whereHas('storeFaculty', function ($has) use ($storeFac) {
            $has->where('store_faculty_id', '=', $storeFac->id);
        });
        foreach ($storeRooms as $storeRoom) {
            $this->update(['status' => $storeFac->status], $storeRoom->id);
        }
    }
    
    /**
     * Get store faculty by year and faculty group by stuff
     *
     * @param any $roomId []
     * @param int $year   []
     *
     * @return query
     */
    public function getStoreFacultyByYearRoom($roomId, $year)
    {
        return StoreRoom::with(['stuff.supplier', 'stuff.kindStuff', 'faculty', 'storeFaculty.detailImportStore'])
            ->where('room_id', '=', $roomId)
            ->where('date_import', '>=', $year . '-01-01')
            ->where('date_import', '<=', $year . '-12-31')
            ->select('stuff_id', DB::raw('sum(quantity) as quantity, sum(quantity_start) as quantity_start'))
            ->groupBy('stuff_id');
    }
}
