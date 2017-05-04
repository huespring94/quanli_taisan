<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Http\Request;
use App\Services\FacultyRoomService;
use App\Services\StuffFacultyService;
use App\Http\Requests\PostImportRoomRequest;

class ImportRoomController extends Controller
{
    private $facultyRoomService;

    private $stuffFacultyService;
    
    /**
     * Constructor of faculty room service
     *
     * @param FacultyRoomService  $facultyRoomService  []
     * @param StuffFacultyService $stuffFacultyService []
     */
    public function __construct(FacultyRoomService $facultyRoomService,
        StuffFacultyService $stuffFacultyService)
    {
        $this->facultyRoomService = $facultyRoomService;
        $this->stuffFacultyService = $stuffFacultyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return '';
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
        $faculty = $this->facultyRoomService->getFacultyById($user->faculty_id);
        $stuff = $this->importStuffService->getStuffById($request->get('stuff_id'));
        $quantity = $request->get('quantity');
        Session::flash('msg', 'success');
        return view('room.detail-import', [
            'storeRooms' => $storeRooms,
            'faculty' => $faculty,
            'stuff' => $stuff,
            'quantity' => $quantity
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id []
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id []
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
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
}
