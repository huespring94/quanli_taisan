<?php

namespace App\Http\Controllers;

use App\Services\HistoryImportService;
use App\Services\StuffFacultyService;

class HistoryImportController extends Controller
{
    private $hisImportService;
    
    private $stuffFacService;
    
    /**
     * Constructor of history import service
     *
     * @param HistoryImportService $hisImportService []
     * @param StuffFacultyService  $stuffFacService  []
     */
    public function __construct(
        HistoryImportService $hisImportService,
        StuffFacultyService $stuffFacService
    ) {
    
        $this->hisImportService = $hisImportService;
        $this->stuffFacService = $stuffFacService;
    }
    
    /**
     * Get store room by store faculty id
     *
     * @param any $id []
     *
     * @return array
     */
    public function getStoreRoomByStoreFaculty($id)
    {
        $storeRooms = $this->hisImportService->getStoreRoomByStoreFaculty($id);
        $importFac = $this->stuffFacService->getStoreFacultyByStoreFaculty($id);
        return view('history.his-faculty', ['storeRooms' => $storeRooms, 'importFac' => $importFac]);
    }
}
