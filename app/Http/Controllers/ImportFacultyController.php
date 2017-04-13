<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImportStuffService;
use App\Services\FacultyRoomService;

class ImportFacultyController extends Controller
{
    private $importStuffService;
    
    private $facultyRoomService;


    /**
     * Constructor of import faculty store controller
     *
     * @param ImportStuffService $importStuffService
     */
    public function __construct(ImportStuffService $importStuffService,
        FacultyRoomService $facultyRoomService)
    {
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
        $importFacs = $this->importStuffService->getAllImportFaculty();
        return view('', ['importFacs' => $importFacs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = $this->facultyRoomService->getAllFaculties();
        $stuffs = $this->importStuffService->getAllStuff();
        return view('faculty.create_import', ['faculties' => $faculties, 'stuffs' => $stuffs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->importStuffService->createImportFaculty();
        return view('');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
