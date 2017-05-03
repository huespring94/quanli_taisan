<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AtrophyService;
use App\Services\MessageService;
use App\Services\LiquidationService;

class AtrophyController extends Controller
{
    private $atrophyService;
    
    private $messageService;
    
    private $liquidationService;

    /**
     * Constructor atrophy controller
     *
     * @param AtrophyService     $atrophyService     []
     * @param MessageService     $messageService     []
     * @param LiquidationService $liquidationService []
     */
    public function __construct(
        AtrophyService $atrophyService,
        MessageService $messageService,
        LiquidationService $liquidationService
    ) {
        $this->atrophyService = $atrophyService;
        $this->messageService = $messageService;
        $this->liquidationService = $liquidationService;
    }
    
    /**
     * Get expire stuff in store
     *
     * @return Reponse
     */
    public function getExpireStuffStore()
    {
        $atrophyStores = $this->messageService->getExpireStuffStore();
        $liquidations = $this->liquidationService->getAllLiquidation();
        return view('atrophy.atrophy-store', [
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
    public function destroy($id)
    {
        $this->liquidationService->removeToLiquordation($id);
        $atrophyStores = $this->messageService->getExpireStuffStore();
        $liquidations = $this->liquidationService->getAllLiquidation();
        return view('atrophy.atrophy-store', [
            'atrophyStores' => $atrophyStores,
            'liquidations' => $liquidations
        ]);
    }
}
