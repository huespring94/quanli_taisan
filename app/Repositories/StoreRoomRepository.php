<?php

namespace App\Repositories;

use App\Models\StoreRoom;

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
}
