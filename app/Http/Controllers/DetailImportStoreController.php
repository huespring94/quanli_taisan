<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImportStuffService;
use App\Http\Requests\PostDetailImportStoreRequest;
use Session;
use Illuminate\Support\Facades\Input;

class DetailImportStoreController extends Controller
{
    /**
     * Import stuff service
     *
     * @var ImportStuffService
     */
    private $importStuffService;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostDetailImportStoreRequest $request)
    {
        $importStore = $this->importStuffService->getImportStoreUserStore($request->toArray()['import_store_id']);
        $detailImports = $this->importStuffService->createDetailImportStore($request);
        $amount = $this->importStuffService->countAmountImportStore($request->toArray()['import_store_id']);
        Session::flash('msg', 'success');
        return view('store.show_detail', [
            'detailImports' => $detailImports,
            'importStore' => $importStore,
            'amount' => $amount
        ]);
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

    public function getQuantityByStuffId()
    {
        $id = Input::get('stuff_id');
        return $this->importStuffService->getQuantityByStuffId($id);
    }
}
