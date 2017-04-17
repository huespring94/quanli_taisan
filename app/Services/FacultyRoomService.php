<?php

namespace App\Services;

use App\Repositories\FacultyRepository;
use App\Repositories\RoomRepository;

class FacultyRoomService extends BaseService
{
    private $facultyRepo;
    
    private $roomRepo;
    
    /**
     * Constructor faculty room service
     *
     * @param FacultyRepository $facultyRepo []
     * @param RoomRepository    $roomRepo    []
     */
    public function __construct(FacultyRepository $facultyRepo, RoomRepository $roomRepo)
    {
        $this->facultyRepo = $facultyRepo;
        $this->roomRepo = $roomRepo;
    }
    
    /**
     * Get all of faculties
     *
     * @return array
     */
    public function getAllFaculties()
    {
        return $this->facultyRepo->all();
    }
    
    /**
     * Get all rooms
     *
     * @return mixed
     */
    public function getAllRoom()
    {
        return $this->roomRepo->all();
    }
}
