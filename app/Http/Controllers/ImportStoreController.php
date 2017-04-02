<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ImportStuffService;
use App\Services\StoreService;
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
     * Store service
     * 
     * @var StoreService
     */
    protected $storeService;

    /**
     * Contructor of stuff controller
     *
     * @param ImportStuffService $importStuffService Import stuff service
     */
    public function __construct(ImportStuffService $importStuffService, StoreService $storeService)
    {
        $this->importStuffService = $importStuffService;
        $this->storeService = $storeService;
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
     */
    public function create()
    {
        $stores = $this->storeService->getAll();
        return view('store.create', ['stores' => $stores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostImportStoreRequest $request []
     *
     * @return object
     */
    public function store(PostImportStoreRequest $request)
    {
        $storeImport = $this->importStuffService->createImportStore($request);
        return view('store.import', ['storeImport' => $storeImport]);
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
