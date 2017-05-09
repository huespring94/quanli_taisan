<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\FacultyRoomService;

class UserController extends Controller
{
    private $userService;
    
    private $facRoomService;

    /**
     * Contructor of user controller
     *
     * @param UserService        $userService    []
     * @param FacultyRoomService $facRoomService []
     */
    public function __construct(
        UserService $userService,
        FacultyRoomService $facRoomService
    ) {
    
        $this->userService = $userService;
        $this->facRoomService = $facRoomService;
    }
    
    /**
     * Get timeline of author
     *
     * @return Reponse
     */
    public function getTimeline()
    {
        $room = $this->facRoomService->getRoomByUser(auth()->user()->id);
        return view('auth.profile', ['room' => $room]);
    }
}
