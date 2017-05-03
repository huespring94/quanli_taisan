<?php

namespace App\Services;

use App\Repositories\DetailImportStoreRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;

class MessageService extends BaseService
{
    private $detailIStoreRepo;
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    /**
     * Constructor message controller
     *
     * @param DetailImportStoreRepository $detailIStoreRepo []
     * @param StoreFacultyRepository      $storeFacultyRepo []
     * @param StoreRoomRepository         $storeRoomRepo    []
     */
    public function __construct(
        DetailImportStoreRepository $detailIStoreRepo,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo
    ) {
        $this->detailIStoreRepo = $detailIStoreRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
    }
    
//    public function getNewRequest()
//    {
//        //
//    }
    
    /**
     * Get expire stuff store
     *
     * @return array
     */
    public function getExpireStuffStore()
    {
        return $this->detailIStoreRepo
                ->with(['stuff', 'importStore.store'])
                ->findWhere([
                    ['quantity', '>', 0],
                    ['status', '<', config('constant.rate_deadline')]
                ]);
    }

    /**
     * Get expire stuff faculty store
     *
     * @return array
     */
    public function getExpireStuffStoreFacul()
    {
        return $this->storeFacultyRepo->findWhere([
            ['quantity', '>', 0],
            ['stuff', '<', config('constant.rate_deadline')]
        ]);
    }
    
    /**
     * Get expire stuff room store
     *
     * @return array
     */
    public function getExpireStuffStoreRoom()
    {
        return $this->storeRoomRepo->findWhere([
            ['quantity', '>', 0],
            ['stuff', '<', config('constant.rate_deadline')]
        ]);
    }
    
    /**
     * Get amount expire stuff store
     *
     * @return array
     */
    public function getAmountExpireStuff()
    {
        return ['store' => count($this->getExpireStuffStore())];
    }
}
