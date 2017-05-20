<?php

namespace App\Services;

use App\Repositories\FacultyRepository;
use App\Repositories\RoomRepository;
use App\Repositories\StoreFacultyRepository;

class FacultyRoomService extends BaseService
{
    private $facultyRepo;
    
    private $roomRepo;
    
    private $storeFacultyRepo;
    
    /**
     * Constructor faculty room service
     *
     * @param FacultyRepository      $facultyRepo      []
     * @param RoomRepository         $roomRepo         []
     * @param StoreFacultyRepository $storeFacultyRepo []
     */
    public function __construct(
        FacultyRepository $facultyRepo,
        RoomRepository $roomRepo,
        StoreFacultyRepository $storeFacultyRepo
    ) {
    
        $this->facultyRepo = $facultyRepo;
        $this->roomRepo = $roomRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
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
    
    /**
     * Get faculty by id faculty
     *
     * @param any $id []
     *
     * @return object
     */
    public function getFacultyById($id)
    {
        return $this->facultyRepo->findByField('faculty_id', $id)->first();
    }
    
    /**
     * Get faculty by id room
     *
     * @param any $roomId []
     *
     * @return object
     */
    public function getFacultyByRoom($roomId)
    {
        return $this->facultyRepo->whereHas('rooms', function ($has) use ($roomId) {
            $has->where('room_id', '=', $roomId);
        })->first();
    }

    /**
     * Get rooms by id faculty
     *
     * @param any $facultyId []
     *
     * @return array
     */
    public function getRoomByFaculty($facultyId)
    {
        return $this->roomRepo->findByField('faculty_id', $facultyId);
    }
    
    /**
     * Get rooms by id room
     *
     * @param any $id []
     *
     * @return object
     */
    public function getRoomById($id)
    {
        return $this->roomRepo->findByField('room_id', $id)->first();
    }
    
    /**
     * Get room by user id
     *
     * @param any $userId []
     *
     * @return object
     */
    public function getRoomByUser($userId)
    {
        return $this->roomRepo->findByField('user_id', $userId)->first();
    }
}
