<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FacultyRoomService;

class HomeController extends Controller
{
    private $facRoomService;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FacultyRoomService $facRoomService)
    {
        $this->middleware('auth');
        $this->facRoomService = $facRoomService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = $this->facRoomService->getRoomByUser(auth()->user()->id);
        return view('auth.profile', ['room' => $room]);
    }
}
