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
}
