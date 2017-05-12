<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LiquidationService;

class LiquidationController extends Controller
{
    private $liquidationService;
    
    public function __construct (LiquidationService $liquidationService)
    {
        $this->liquidationService = $liquidationService;
    }
    
    public function getLiquiByFaculty()
    {
        $liquidations = $this->liquidationService->getAllLiquidationFaculty();
        return view('atrophy.list-liquidation', ['liquidations' => $liquidations]);
    }
    
}
