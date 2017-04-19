<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ImportStuffService;
use App\Services\StoreService;
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
     * Store service
     *
     * @var StoreService
     */
    private $storeService;

    /**
     * Contructor of stuff controller
     *
     * @param ImportStuffService $importStuffService Import stuff service
     * @param StoreService       $storeService       Store service
     */
    public function __construct(ImportStuffService $importStuffService, StoreService $storeService)
    {
        $this->importStuffService = $importStuffService;
        $this->storeService = $storeService;
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
     * @param \Illuminate\Http\Request $request []
     *
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
     * @param int $id []
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('day ha');
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
        $detailImport = $this->importStuffService->getDetailImportStoreById($id);
        $storeImport = $detailImport->importStore;
        $stuffs = $this->importStuffService->getAllStuff();
        return view('store.update_detail', ['detailImport' => $detailImport, 'storeImport' => $storeImport, 'stuffs' => $stuffs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request []
     * @param int                      $id      []
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PostDetailImportStoreRequest $request, $id)
    {
        $importStore = $this->importStuffService->getImportStoreUserStore($request->all()['import_store_id']);
        $detailImports = $this->importStuffService->updateDetailImportStore($request, $id);
        $amount = $this->importStuffService->countAmountImportStore($request->all()['import_store_id']);
        Session::flash('msg', 'update success');
        return view('store.show_detail', [
            'detailImports' => $detailImports,
            'importStore' => $importStore,
            'amount' => $amount
        ]);
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
        Session::flush();
        $detailDeleted = $this->importStuffService->deleteDetailImportStore($id);
        if (empty($detailDeleted)) {
            Session::flash('msg', 'Đơn nhập hàng trống. Mời nhập mới!');
            $stores = $this->storeService->getAll();
            return view('store.create', ['stores' => $stores]);
        }
        $importStore = $this->importStuffService->getImportStoreById($detailDeleted->import_store_id);
        $detailImports = $this->importStuffService->getDetailImportStoreByIStoreId($detailDeleted->import_store_id);
        $amount = $this->importStuffService->countAmountImportStore($detailDeleted->import_store_id);
        Session::flash('msg', 'delete success');
        return view('store.show_detail', [
            'detailImports' => $detailImports,
            'importStore' => $importStore,
            'amount' => $amount
        ]);
    }

    /**
     * Get quantity by stuff id
     *
     * @return int
     */
    public function getQuantityByStuffId()
    {
        $id = Input::get('stuff_id');
        return $this->importStuffService->getQuantityByStuffId($id);
    }
}
