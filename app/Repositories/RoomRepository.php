<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Room::class;
    }
}
