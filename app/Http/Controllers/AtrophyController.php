<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AtrophyService;
use App\Services\MessageService;
use App\Services\LiquidationService;
use App\Services\StuffFacultyService;
use App\Services\RequestService;

class AtrophyController extends Controller
{
    private $atrophyService;
    
    private $messageService;
    
    private $liquidationService;
    
    private $stuffFacService;
    
    private $requestService;

    /**
     * Constructor atrophy controller
     *
     * @param AtrophyService         $atrophyService     []
     * @param MessageService         $messageService     []
     * @param LiquidationService     $liquidationService []
     * @param StoreFacultyRepository $storeFacultyRepo   []
     */
    public function __construct(
        AtrophyService $atrophyService,
        MessageService $messageService,
        LiquidationService $liquidationService,
        StuffFacultyService $stuffFacService,
        RequestService $requestService
    ) {
        $this->atrophyService = $atrophyService;
        $this->messageService = $messageService;
        $this->liquidationService = $liquidationService;
        $this->stuffFacService = $stuffFacService;
        $this->requestService = $requestService;
    }
    
    /**
     * Get expire stuff in store
     *
     * @return Reponse
     */
    public function getExpireStuffStore()
    {
        $atrophyStores = $this->messageService->getExpireStuffStore();
        $liquidations = $this->liquidationService->getAllLiquidationShort();
        return view('atrophy.atrophy-store', [
            'atrophyStores' => $atrophyStores,
            'liquidations' => $liquidations
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
     * Get expire stuff in store room
     *
     * @return Reponse
     */
    public function getExpireStuffStoreRoom()
    {
        //
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
        $this->liquidationService->removeToLiquordation($id);
        $atrophyStores = $this->messageService->getExpireStuffStore();
        $liquidations = $this->liquidationService->getAllLiquidationShort();
        return view('atrophy.atrophy-store', [
            'atrophyStores' => $atrophyStores,
            'liquidations' => $liquidations
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
    /**
     * Move to liquidation
     *
     * @param any $id []
     *
     * @return Reponse
     */
    public function destroyRoom()
    {
        //
    }
}
