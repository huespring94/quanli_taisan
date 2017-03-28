<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImportStuffService;
use App\Repositories\ImportStoreRepository;

class ImportStoreController extends Controller
{
    /**
     * Import stuff service
     * 
     * @var ImportStuffService
     */
    protected $importStuffService;
    private $importStoreRepo;
    
    /**
     * Contructor of stuff controller
     * 
     * @param \App\Http\Controllers\ImportStuffService $importStuffService []
     */
    public function __construct(ImportStuffService $importStuffService, ImportStoreRepository $importStoreRepo)
    {
        $this->importStuffService = $importStuffService;
        $this->importStoreRepo = $importStoreRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abc = $this->importStuffService->getAllImportStore();
                dd($abc);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $abc = $this->importStoreRepo->findByField('date_import', '2017-10-10 00:00:00')->first();
//                dd($abc);
        return $this->importStuffService->createImportStore();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
