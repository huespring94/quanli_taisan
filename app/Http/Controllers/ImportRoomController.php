<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Http\Request;
use App\Services\FacultyRoomService;
use App\Services\StuffFacultyService;
use App\Http\Requests\PostImportRoomRequest;
use App\Services\ImportStuffService;

class ImportRoomController extends Controller
{
    private $facultyRoomService;

    private $stuffFacultyService;
    
    private $importStuffService;
    
    /**
     * Constructor of faculty room service
     *
     * @param FacultyRoomService  $facultyRoomService  []
     * @param StuffFacultyService $stuffFacultyService []
     * @param ImportStuffService  $importStuffService  []
     */
    public function __construct(
        FacultyRoomService $facultyRoomService,
        StuffFacultyService $stuffFacultyService,
        ImportStuffService $importStuffService
    ) {
    
        $this->facultyRoomService = $facultyRoomService;
        $this->stuffFacultyService = $stuffFacultyService;
        $this->importStuffService = $importStuffService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = $this->facultyRoomService->getRoomByFaculty(auth()->user()->faculty_id);
        $storeRooms = $this->stuffFacultyService->getStuffAllRoom();
        return view('room.index', ['rooms' => $rooms, 'storeRooms' => $storeRooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth('web')->user();
        $rooms = $this->facultyRoomService->getRoomByFaculty($user->faculty_id);
        $stuffs = $this->stuffFacultyService->getStuffInStoreFacutyByFaculty($user->faculty_id);
        return view('room.create', ['rooms' => $rooms, 'stuffs' => $stuffs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostImportRoomRequest $request []
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostImportRoomRequest $request)
    {
        $user = auth('web')->user();
        $storeRooms = $this->stuffFacultyService->createImportStoreRoom($request);
        if (empty($storeRooms)) {
            Session::flash('msg-i-f', 'Số lượng yêu cầu vượt quá số lượng hiện có');
            $rooms = $this->facultyRoomService->getRoomByFaculty($user->faculty_id);
            $stuffs = $this->stuffFacultyService->getStuffInStoreFacutyByFaculty($user->faculty_id);
            return view('room.create', ['rooms' => $rooms, 'stuffs' => $stuffs]);
        }
        $room = $this->facultyRoomService->getRoomById($request->get('room_id'));
        $stuff = $this->importStuffService->getStuffById($request->get('stuff_id'));
        $quantity = $request->get('quantity');
        Session::flash('msg', 'success');
        return view('room.detail-import', [
            'storeRooms' => $storeRooms,
            'room' => $room,
            'stuff' => $stuff,
            'quantity' => $quantity
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request []
     * @param int                      $id      []
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request . $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id []
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }
    
    /**
     * Get quantity by stuff id
     *
     * @return int
     */
    public function getQuantityByStuffId()
    {
        $id = Input::get('stuff_id');
        return $this->stuffFacultyService->getQuantityByStuffId($id);
    }
    
    /**
     * Get quantity by stuff id
     *
     * @param Request $request []
     *
     * @return int
     */
    public function getImportRoomByFaculty(Request $request)
    {
        $rooms = $this->facultyRoomService->getRoomByFaculty(auth()->user()->faculty_id);
        $storeRooms = $this->stuffFacultyService->getImportRoomByRoom($request->get('room_id'));
        $roomId = $request->get('room_id');
        return view('room.index', ['rooms' => $rooms, 'storeRooms' => $storeRooms, 'roomId' => $roomId]);
    }
}
