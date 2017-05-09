<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RequestService;
use App\Services\MessageService;
use App\Services\LiquidationService;
use App\Services\StuffFacultyService;
use Session;
use App\Services\FacultyRoomService;
use App\Models\Request as Req;

class RequestController extends Controller
{
    private $requestService;
    
    private $messageService;
    
    private $liquidationService;
    
    private $stuffFacService;
    
    private $facRoomService;

    /**
     * Constructor for request controller
     *
     * @param RequestService      $requestService     []
     * @param MessageService      $messageService     []
     * @param LiquidationService  $liquidationService []
     * @param StuffFacultyService $stuffFacService    []
     * @param FacultyRoomService  $facRoomService     []
     */
    public function __construct(
        RequestService $requestService,
        MessageService $messageService,
        LiquidationService $liquidationService,
        StuffFacultyService $stuffFacService,
        FacultyRoomService $facRoomService
    ) {
    
        $this->requestService = $requestService;
        $this->messageService = $messageService;
        $this->liquidationService = $liquidationService;
        $this->stuffFacService = $stuffFacService;
        $this->facRoomService = $facRoomService;
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
    
    /**
     * Create request
     *
     * @param Request $request []
     *
     * @return Reponse
     */
    public function storeRoom(Request $request)
    {
        $storeTypeId = $this->requestService->createRequest($request, Req::TYPE_ROOM);
        if ($storeTypeId == null) {
            Session::flash('msg', 'Số lượng vượt quá số lượng hiện có.');
        }
        $roomId = $this->facRoomService->getRoomByUser(auth()->user()->id)->room_id;
        $atrophyStores = $this->messageService->getExpireStuffStoreRoom();
        $waitLiquidations = $this->requestService->getRequestNotLiquidationByRoom($roomId);
        return view('atrophy.atrophy-room', [
            'atrophyStores' => $atrophyStores,
            'liquidations' => $waitLiquidations,
        ]);
    }
}
