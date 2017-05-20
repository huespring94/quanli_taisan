<?php

namespace App\Http\Controllers;

use App\Services\AtrophyService;
use App\Services\MessageService;
use App\Services\LiquidationService;
use App\Services\StuffFacultyService;
use App\Services\RequestService;
use App\Services\FacultyRoomService;
use Session;

class AtrophyController extends Controller
{
    private $atrophyService;
    
    private $messageService;
    
    private $liquidationService;
    
    private $stuffFacService;
    
    private $requestService;
    
    private $facRoomService;

    /**
     * Constructor atrophy controller
     *
     * @param AtrophyService      $atrophyService     []
     * @param MessageService      $messageService     []
     * @param LiquidationService  $liquidationService []
     * @param StuffFacultyService $stuffFacService    []
     * @param RequestService      $requestService     []
     * @param FacultyRoomService  $facRoomService     []
     */
    public function __construct(
        AtrophyService $atrophyService,
        MessageService $messageService,
        LiquidationService $liquidationService,
        StuffFacultyService $stuffFacService,
        RequestService $requestService,
        FacultyRoomService $facRoomService
    ) {
        $this->atrophyService = $atrophyService;
        $this->messageService = $messageService;
        $this->liquidationService = $liquidationService;
        $this->stuffFacService = $stuffFacService;
        $this->requestService = $requestService;
        $this->facRoomService = $facRoomService;
    }
    
    /**
     * Get expire stuff in store
     *
     * @return Reponse
     */
    public function getExpireStuffStore()
    {
        $atrophyStores = $this->messageService->getExpireStuffStore();
        return view('atrophy.atrophy-store', [
            'atrophyStores' => $atrophyStores,
        ]);
    }
    
    /**
     * Get expire stuff in store faculty
     *
     * @return Reponse
     */
    public function getExpireStuffStoreFaculty()
    {
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
     * Get expire stuff in store faculty
     *
     * @param any $id []
     *
     * @return Reponse
     */
    public function deleteWaitLiquidation($id)
    {
        $this->requestService->deleteReqWaitLiquidation($id);
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
     * Get expire stuff in store room
     *
     * @return Reponse
     */
    public function getExpireStuffStoreRoom()
    {
        $roomId = $this->facRoomService->getRoomByUser(auth()->user()->id)->room_id;
        $atrophyStores = $this->messageService->getExpireStuffStoreRoom();
        $waitLiquidations = $this->requestService->getRequestNotLiquidationByRoom($roomId);
        return view('atrophy.atrophy-room', [
            'atrophyStores' => $atrophyStores,
            'liquidations' => $waitLiquidations,
        ]);
    }

    /**
     * Move to liquidation
     *
     * @param any $id []
     *
     * @return Reponse
     */
    public function destroy($id)
    {
        $this->liquidationService->removeToLiquidation($id);
        $atrophyStores = $this->messageService->getExpireStuffStore();
        Session::flash('msg', 'Thanh lí tài sản thành công.');
        return view('atrophy.atrophy-store', [
            'atrophyStores' => $atrophyStores,
        ]);
    }
    
    /**
     * Move to liquidation and delete in store faculty
     *
     * @param any $id []
     *
     * @return Reponse
     */
    public function destroyFaculty($id)
    {
        $this->liquidationService->removeToLiquordationFaculty($id);
        $atrophyStores = $this->messageService->getExpireStuffStoreFacul();
        $liquidations = $this->liquidationService->getAllLiquidationFaculty();
        return view('atrophy.atrophy-faculty-room', [
            'atrophyStores' => $atrophyStores,
            'liquidations' => $liquidations
        ]);
    }
}
