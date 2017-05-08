<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RequestService;
use App\Services\MessageService;
use App\Services\LiquidationService;
use App\Services\StuffFacultyService;
use Session;

class RequestController extends Controller
{
    private $requestService;
    
    private $messageService;
    
    private $liquidationService;
    
    private $stuffFacService;

    /**
     * Constructor for request controller
     *
     * @param RequestService $requestService         []
     * @param MessageService $messageService         []
     * @param LiquidationService $liquidationService []
     * @param StuffFacultyService $stuffFacService   []
     */
    public function __construct(
        RequestService $requestService,
        MessageService $messageService,
        LiquidationService $liquidationService,
        StuffFacultyService $stuffFacService
    )
    {
        $this->requestService = $requestService;
        $this->messageService = $messageService;
        $this->liquidationService = $liquidationService;
        $this->stuffFacService = $stuffFacService;
    }

    /**
     * Create request
     *
     * @param Request $request []
     *
     * @return Reponse
     */
    public function storeFaculty(Request $request)
    {
        $storeTypeId = $this->requestService->createRequest($request);
        if ($storeTypeId == null) {
            Session::flash('msg', 'Số lượng vượt quá số lượng hiện có.');
        }
        $storeFaculties = $this->stuffFacService->getStoreFacultyByFacultyNotZero(auth()->user()->faculty_id);
        $atrophyStores = $this->messageService->getExpireStuffStoreFacul();
        $waitLiquidations = $this->requestService->getRequestNotLiquidationByFaculty(auth()->user()->faculty_id);
        return view('atrophy.atrophy-faculty-room', [
            'atrophyStores' => $atrophyStores,
            'liquidations' => $waitLiquidations,
            'storeFaculties' => $storeFaculties
        ]);
    }
}
