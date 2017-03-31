<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImportStuffService;
use App\Http\Requests\PostImportStoreRequest;

class ImportStoreController extends Controller
{
    /**
     * Import stuff service
     *
     * @var ImportStuffService
     */
    protected $importStuffService;
    
    /**
     * Contructor of stuff controller
     *
     * @param ImportStuffService $importStuffService Import stuff service
     */
    public function __construct(ImportStuffService $importStuffService)
    {
        $this->importStuffService = $importStuffService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return object
     */
    public function index()
    {
        return $this->importStuffService->getAllImportStore();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param PostImportStoreRequest $request []
     *
     * @return object
     */
    public function create(PostImportStoreRequest $request)
    {
        return $this->importStuffService->createImportStore($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request []
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
        //
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
        //
    }
}
