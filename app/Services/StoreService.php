<?php

namespace App\Services;

use App\Repositories\StoreRepository;

class StoreService extends BaseService
{
    /**
     * Store repository
     *
     * @var StoreRepository
     */
    protected $storeRepo;
    
    /**
     * Constructor of store service
     *
     * @param StoreRepository $storeRepo []
     */
    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepo = $storeRepo;
    }
    
    /**
     * Get all of store
     *
     * @return array
     */
    public function getAll()
    {
        return $this->storeRepo->all();
    }
}
