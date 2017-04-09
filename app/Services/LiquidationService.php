<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\LiquidationRepository;

class LiquidationService extends BaseService
{
    /**
     * Liquidation repository
     *
     * @var LiquidationRepository
     */
    private $liquidationRepo;
    
    /**
     * Constructor of liquidation service 
     *
     * @param LiquidationRepository $liquidationRepo
     */
    public function __construct(LiquidationRepository $liquidationRepo)
    {
        $this->liquidationRepo = $liquidationRepo;
    }
}
