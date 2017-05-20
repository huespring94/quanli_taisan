<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StatisticalService;
use App\Services\FacultyRoomService;

class StatisticalController extends Controller
{
    private $statisService;
    
    private $facRoomService;
    
    /**
     * Constructor of statistical controller
     *
     * @param StatisticalService $statisService  []
     * @param FacultyRoomService $facRoomService []
     */
    public function __construct(
        StatisticalService $statisService,
        FacultyRoomService $facRoomService
    ) {
        $this->statisService = $statisService;
        $this->facRoomService = $facRoomService;
    }
    
    /**
     * Statistical by faculty and year
     *
     * @return Reponse
     */
    public function statisticByFacultyYear()
    {
        $user = auth()->user();
        $years = $this->statisService->getYearStoreFacultyByFaculty($user->faculty_id);
        $importFacs = $this->statisService->getStoreFacultyByYear($years['now'], $user->faculty_id);
        return view('statistic.sta-faculty', ['years' => $years, 'importFacs' => $importFacs]);
    }
    
    /**
     * Statistical by room and year
     *
     * @return Reponse
     */
    public function statisticByRoomYear()
    {
        $user = auth()->user();
        $years = $this->statisService->getYearStoreFacultyByFaculty($user->faculty_id);
        $rooms = $this->facRoomService->getRoomByFaculty($user->faculty_id);
        $importRooms = $this->statisService->getStoreRoomByYearRoom($years['now'], $rooms->first()->room_id);
        return view('statistic.sta-room', ['years' => $years, 'importRooms' => $importRooms, 'rooms' => $rooms]);
    }
    
    /**
     * Statistical by room and year
     *
     * @return Reponse
     */
    public function statisticByRoomOwnYear()
    {
        $user = auth()->user();
        $years = $this->statisService->getYearStoreFacultyByFaculty($user->faculty_id);
        $room = $this->facRoomService->getRoomByUser(auth()->user()->id);
        $importRooms = $this->statisService->getStoreRoomByYearRoom($years['now'], $room->room_id);
        return view('statistic.sta-room-own', ['years' => $years, 'importRooms' => $importRooms, 'room' => $room]);
    }
    
    /**
     * Statistical by faculty and year
     *
     * @param Request $request []
     *
     * @return Reponse
     */
    public function statisticByFacultyByYear(Request $request)
    {
        $user = auth()->user();
        $years = $this->statisService->getYearStoreFacultyByFaculty($user->faculty_id);
        $years['now'] = $request->get('year');
        $importFacs = $this->statisService->getStoreFacultyByYear($years['now'], $user->faculty_id);
        return view('statistic.sta-faculty', ['years' => $years, 'importFacs' => $importFacs]);
    }
    
    /**
     * Statistical by room and year
     *
     * @param Request $request []
     *
     * @return Reponse
     */
    public function statisticByRoomByYear(Request $request)
    {
        $user = auth()->user();
        $years = $this->statisService->getYearStoreFacultyByFaculty($user->faculty_id);
        $years['now'] = $request->get('year');
        $roomId = $request->get('room_id');
        $rooms = $this->facRoomService->getRoomByFaculty($user->faculty_id);
        $importRooms = $this->statisService->getStoreRoomByYearRoom($years['now'], $roomId);
        return view('statistic.sta-room', ['years' => $years, 'importRooms' => $importRooms, 'rooms' => $rooms, 'roomId' => $roomId]);
    }
    
    /**
     * Detail statistical by faculty, year and stuff
     *
     * @param int $year    []
     * @param any $stuffId []
     *
     * @return Reponse
     */
    public function detailStatisticByFacultyYearStuff($year, $stuffId)
    {
        $user = auth()->user();
        $importFacs = $this->statisService->getStoreFacultyByStoreFaculty($user->faculty_id, $year, $stuffId);
        return view('statistic.sta-faculty-detail', ['importFacs' => $importFacs]);
    }
}
