<?php

namespace App\Services;

use App\Repositories\DetailImportStoreRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;
use App\Services\RequestService;
use App\Services\FacultyRoomService;

class MessageService extends BaseService
{
    private $detailIStoreRepo;
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    private $requestService;
    
    private $facRoomService;

    /**
     * Constructor message controller
     *
     * @param DetailImportStoreRepository $detailIStoreRepo []
     * @param StoreFacultyRepository      $storeFacultyRepo []
     * @param StoreRoomRepository         $storeRoomRepo    []
     * @param RequestService              $requestService   []
     * @param FacultyRoomService          $facRoomService   []
     */
    public function __construct(
        DetailImportStoreRepository $detailIStoreRepo,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo,
        RequestService $requestService,
        FacultyRoomService $facRoomService
    ) {
        $this->detailIStoreRepo = $detailIStoreRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
        $this->requestService = $requestService;
        $this->facRoomService = $facRoomService;
    }
    
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
        $facultyId = auth()->user()->faculty_id;
        $notLiquidations = $this->requestService->getRequestNotLiquidationByFaculty($facultyId)
                ->pluck('quantity', 'store_type_id')->all();
        $storeFaculties = $this->storeFacultyRepo
            ->with(['stuff', 'detailImportStore'])
            ->whereHas('detailImportStore', function ($has) {
                $has->where('status', '<', config('constant.rate_deadline'));
            })
            ->findWhere([
                ['quantity', '>', 0],
                ['faculty_id', '=', $facultyId]
            ]);
        foreach ($storeFaculties as $storeFaculty) {
            if (in_array($storeFaculty->store_faculty_id, array_keys($notLiquidations))) {
                $storeFaculty['num_liquidation'] = $notLiquidations[$storeFaculty->store_faculty_id];
            }
        }
        return $storeFaculties;
    }

    /**
     * Get expire stuff room store
     *
     * @return array
     */
    public function getExpireStuffStoreRoom()
    {
        $roomId = $this->facRoomService->getRoomByUser(auth()->user()->id)->room_id;
        $notLiquidations = $this->requestService->getRequestAllLiquidationByRoom($roomId)
                ->pluck('quantity', 'store_type_id')->all();
        $storeRooms = $this->storeRoomRepo
            ->with(['stuff', 'storeFaculty.detailImportStore'])
            ->whereHas('storeFaculty.detailImportStore', function ($has) {
                $has->where('status', '<', config('constant.rate_deadline'));
            })
            ->findWhere([
            ['room_id', '=', $roomId]
            ]);
        foreach ($storeRooms as $storeRoom) {
            if (in_array($storeRoom->store_room_id, array_keys($notLiquidations))) {
                $storeRoom['num_liquidation'] = $notLiquidations[$storeRoom->store_room_id];
            }
        }
        return $storeRooms;
    }

    /**
     * Get amount expire stuff store
     *
     * @return array
     */
    public function getAmountExpireStuff()
    {
        $role = auth()->user()->role->name;
        if ($role == config('constant.r_admin') || $role == config('constant.r_accountant')) {
            return ['store' => count($this->getExpireStuffStore())];
        } elseif ($role == config('constant.r_faculty')) {
            return ['store' => count($this->getExpireStuffStoreFacul())];
        } elseif ($role == config('constant.r_room')) {
            return ['store' => count($this->getExpireStuffStoreRoom())];
        }
        return '';
    }
}
