<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LiquidationService;

class LiquidationController extends Controller
{
    private $liquidationService;
    
    /**
     * Constructor of liquidation controller
     *
     * @param LiquidationService $liquidationService []
     */
    public function __construct(LiquidationService $liquidationService)
    {
        $this->liquidationService = $liquidationService;
    }
    
    /**
     * Get liquidation by faculty
     *
     * @return Response
     */
    public function getLiquiByFaculty()
    {
        $liquidations = $this->liquidationService->getAllLiquidationFaculty();
        return view('atrophy.list-liquidation', ['liquidations' => $liquidations]);
    }
    
    /**
     * Get liquidation by room
     *
     * @return Response
     */
    public function getLiquiByRoom()
    {
        $liquidations = $this->liquidationService->getAllLiquidationRoom();
        return view('atrophy.list-liquidation', ['liquidations' => $liquidations]);
    }
    
    /**
     * Get all liquidation
     *
     * @return Response
     */
    public function getAllLiquidation()
    {
        $liquidations = $this->liquidationService->getAllLiquidation();
        return view('atrophy.list-liquidation', ['liquidations' => $liquidations]);
    }
}
