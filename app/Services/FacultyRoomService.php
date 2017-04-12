<?php

namespace App\Services;

use App\Repositories\FacultyRepository;
use App\Repositories\RoomRepository;

class FacultyRoomService extends BaseService
{
    private $facultyRepo;
    
    private $roomRepo;
    
    public function __construct(FacultyRepository $facultyRepo, RoomRepository $roomRepo)
    {
        $this->facultyRepo = $facultyRepo;
        $this->roomRepo = $roomRepo;
    }
    
    public function getAllFaculty()
    {
        return $this->facultyRepo->all();
    }
    
    public function getAllRoom()
    {
        return $this->roomRepo->all();
    }
    
    
    
}
