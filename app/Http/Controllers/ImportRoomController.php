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
        $storeRooms = $this->stuffFacultyService->getImportRoomAllByRoom($rooms->first()->room_id);
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
        Session::flash('msg', 'Nhập thành công');
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
     * @param any $id []
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rooms = $this->facultyRoomService->getRoomByFaculty(auth()->user()->faculty_id);
        $storeRooms = $this->stuffFacultyService->getImportRoomAllByRoom($id);
        $roomId = $id;
        return view('room.index', ['rooms' => $rooms, 'storeRooms' => $storeRooms, 'roomId' => $roomId]);
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
     * @param Request $request []
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->stuffFacultyService->prepareCreateImportRoom($request->all());
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
     * @return Response
     */
    public function getImportRoomByFaculty(Request $request)
    {
        $rooms = $this->facultyRoomService->getRoomByFaculty(auth()->user()->faculty_id);
        $storeRooms = $this->stuffFacultyService->getImportRoomAllByRoom($request->get('room_id'));
        $roomId = $request->get('room_id');
        return view('room.index', ['rooms' => $rooms, 'storeRooms' => $storeRooms, 'roomId' => $roomId]);
    }
    
    /**
     * Get import room by own user
     *
     * @return Response
     */
    public function getImportRoomByRoom()
    {
        $roomId = $this->facultyRoomService->getRoomByUser(auth()->user()->id)->room_id;
        $storeRooms = $this->stuffFacultyService->getImportRoomAllByRoom($roomId);
        return view('room.index-room', ['storeRooms' => $storeRooms]);
    }
    
    /**
     * Update quantity store room
     *
     * @param Request $request []
     *
     * @return Response
     */
    public function updateStoreRoom(Request $request)
    {
        $result = $this->stuffFacultyService->updateStoreRoom($request);
        if ($result) {
            Session::flash('msg', 'Cập nhật thành công.');
            $quantity = $request->get('quantity');
        } else {
            Session::flash('msge', 'Không thể cập nhật.');
            $quantity = null;
        }
        $rooms = $this->facultyRoomService->getRoomByFaculty(auth()->user()->faculty_id);
        $storeRooms = $this->stuffFacultyService->getImportRoomAllByRoom($rooms->first()->room_id);
        return view('room.index', ['rooms' => $rooms, 'storeRooms' => $storeRooms, 'quantity' => $quantity]);
    }
    
    /**
     * Delete store room
     *
     * @param any $id []
     *
     * @return Response
     */
    public function deleteStoreRoom($id)
    {
        $this->stuffFacultyService->deleteStoreRoom($id);
        $rooms = $this->facultyRoomService->getRoomByFaculty(auth()->user()->faculty_id);
        $storeRooms = $this->stuffFacultyService->getImportRoomAllByRoom($rooms->first()->room_id);
        Session::flash('msg', 'Xóa thành công.');
        return view('room.index', ['rooms' => $rooms, 'storeRooms' => $storeRooms]);
    }
}
