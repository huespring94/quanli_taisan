<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImportStuffService;
use App\Services\FacultyRoomService;
use App\Http\Requests\PostImportFacultyRequest;
use Session;

class ImportFacultyController extends Controller
{
    private $importStuffService;
    
    private $facultyRoomService;


    /**
     * Constructor of import faculty store controller
     *
     * @param ImportStuffService $importStuffService []
     * @param FacultyRoomService $facultyRoomService []
     */
    public function __construct(
        ImportStuffService $importStuffService,
        FacultyRoomService $facultyRoomService
    ) {
    
        $this->importStuffService = $importStuffService;
        $this->facultyRoomService = $facultyRoomService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = $this->facultyRoomService->getAllFaculties();
        $importFacs = $this->importStuffService->getAllImportFaculty();
        return view('faculty.index', ['importFacs' => $importFacs, 'faculties' => $faculties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::forget('msg');
        $faculties = $this->facultyRoomService->getAllFaculties();
        $stuffs = $this->importStuffService->getAllStuff();
        return view('faculty.create_import', ['faculties' => $faculties, 'stuffs' => $stuffs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request []
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostImportFacultyRequest $request)
    {
        Session::forget('msg');
        $importFaculties = $this->importStuffService->createImportFaculty($request);
        if (empty($importFaculties)) {
            Session::flash('msg-i-f', 'Số lượng yêu cầu vượt quá số lượng hiện có');
            $faculties = $this->facultyRoomService->getAllFaculties();
            $stuffs = $this->importStuffService->getAllStuff();
            return view('faculty.create_import', ['faculties' => $faculties, 'stuffs' => $stuffs]);
        }
        $faculty = $this->facultyRoomService->getFacultyById($request->get('faculty_id'));
        $stuff = $this->importStuffService->getStuffById($request->get('stuff_id'));
        $quantity = $request->get('quantity');
        Session::flash('msg', 'success');
        return view('faculty.detail_import', [
            'importFaculties' => $importFaculties,
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
     * @param Request $request []
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->importStuffService->prepareCreateImportFaculty($request->all());
        if ($result) {
            dd('thanh cong');
        } else {
            dd('ko the xoa');
        }
    }
    
    /**
     * Get import faculty by faculty id
     *
     * @param Request $request []
     *
     * @return \Illuminate\Http\Response
     */
    public function getImportFacultyByFaculty(Request $request)
    {
        $faculties = $this->facultyRoomService->getAllFaculties();
        $importFacs = $this->importStuffService->getImportFacultyByFaculty($request->all()['faculty_id']);
        $facultyId = $request->all()['faculty_id'];
        return view('faculty.index', ['importFacs' => $importFacs, 'faculties' => $faculties, 'facultyId' => $facultyId]);
    }
}
