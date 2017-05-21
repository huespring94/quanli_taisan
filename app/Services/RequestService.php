<?php

namespace App\Services;

use App\Repositories\RequestRepository;
use App\Models\Request;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;
use App\Services\LiquidationService;

class RequestService
{
    protected $requestRepository;
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;
    
    private $liquiService;

    /**
     * Constructor for request service
     *
     * @param RequestRepository      $requestRepo      []
     * @param StoreFacultyRepository $storeFacultyRepo []
     * @param StoreRoomRepository    $storeRoomRepo    []
     * @param LiquidationService     $liquiService     []
     */
    public function __construct(
        RequestRepository $requestRepo,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo,
        LiquidationService $liquiService
    ) {
        $this->requestRepository = $requestRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
        $this->liquiService = $liquiService;
    }
    
    /**
     * Create request
     *
     * @param Request $request []
     * @param string  $type    []
     *
     * @return any
     */
    public function createRequest($request, $type = Request::TYPE_FACULTY)
    {
        $datas = $request->only('store_type_id', 'quantity', 'note');
        $datas['kind_request'] = Request::KIND_REQ_ONE;
        $requestInfo = $this->requestRepository->findWhere([
            ['store_type_id', '=', $datas['store_type_id']],
            ['status', '=', 0]
        ])->first();
        if ($requestInfo == null) {
            $requestInfo['quantity'] = 0;
        }
        if ($type == Request::TYPE_ROOM) {
            $storeRoom = $this->storeRoomRepo->findByField('store_room_id', $datas['store_type_id'])->first();
            if ($datas['quantity'] > ($storeRoom->quantity - $requestInfo['quantity'])) {
                return null;
            }
            $datas['type'] = Request::TYPE_ROOM;
        } else {
            $storeFac = $this->storeFacultyRepo->findByField('store_faculty_id', $datas['store_type_id'])->first();
            if ($datas['quantity'] > ($storeFac->quantity - $requestInfo['quantity'])) {
                return null;
            }
            $datas['type'] = Request::TYPE_FACULTY;
        }
        $datas['status'] = 0;
        $conditions = [
            'store_type_id' => $datas['store_type_id'],
            'kind_request' => $datas['kind_request'],
            'type' => $datas['type'],
            'status' => $datas['status']
        ];
        $this->requestRepository->updateOrCreateQuantity($conditions, $datas, 'quantity');
        return $datas['store_type_id'];
    }
    
    /**
     * Accept request
     *
     * @param any $requestId []
     *
     * @return void
     */
    public function acceptRequest($requestId)
    {
        $request = $this->requestRepository->find($requestId);
        $request->status = 1;
        $request->save();
        $this->liquiService->createLiquidationByRequest($requestId);
        if ($request->type == Request::TYPE_FACULTY) {
            $storeFaculty = $this->storeFacultyRepo->findByField('store_faculty_id', $request->store_type_id)->first();
            if ($storeFaculty->quantity_start == $request->quantity) {
                $this->storeFacultyRepo->deleteWhere(['store_faculty_id' => $request->store_type_id]);
            }
        } else {
            $storeFaculty = $this->storeRoomRepo->findByField('store_room_id', $request->store_type_id)->first();
            if ($storeFaculty->quantity_start == $request->quantity) {
                $this->storeRoomRepo->deleteWhere(['store_room_id' => $request->store_type_id]);
            }
        }
    }
    
    /**
     * Accept all request
     *
     * @return void
     */
    public function acceptAllRequest()
    {
        $requests = $this->requestRepository->all();
        foreach ($requests as $request) {
            $this->acceptRequest($request->id);
        }
    }
    
    /**
     * Get request not liquidation by faculty
     *
     * @param any $facultyId []
     *
     * @return mixed
     */
    public function getRequestNotLiquidationByFaculty($facultyId)
    {
        return $this->requestRepository
            ->with('storeFaculty.stuff')
            ->whereHas('storeFaculty', function ($has) use ($facultyId) {
                $has->where('faculty_id', '=', $facultyId);
            })
            ->findWhere([
                ['status', '=', 0],
                ['type', '=', Request::TYPE_FACULTY],
                ['kind_request', '=', Request::KIND_REQ_ONE]
            ]);
    }
    
    /**
     * Get request not liquidation by faculty
     *
     * @param any $roomId []
     *
     * @return mixed
     */
    public function getRequestNotLiquidationByRoom($roomId)
    {
        return $this->requestRepository
            ->with('storeRoom.stuff')
            ->whereHas('storeRoom', function ($has) use ($roomId) {
                $has->where('room_id', '=', $roomId);
            })
            ->findWhere([
                ['status', '=', 0],
                ['type', '=', Request::TYPE_ROOM],
                ['kind_request', '=', Request::KIND_REQ_ONE]
            ]);
    }
    
    /**
     * Get all request liquidation by room
     *
     * @param any $roomId []
     *
     * @return mixed
     */
    public function getRequestAllLiquidationByRoom($roomId)
    {
        return $this->requestRepository
            ->with('storeRoom.stuff')
            ->whereHas('storeRoom', function ($has) use ($roomId) {
                $has->where('room_id', '=', $roomId);
            })
            ->findWhere([
                ['type', '=', Request::TYPE_ROOM],
                ['kind_request', '=', Request::KIND_REQ_ONE]
            ]);
    }
    
    /**
     * Get request liquidation by faculty
     *
     * @param any $facultyId []
     *
     * @return mixed
     */
    public function getRequestLiquidationByFaculty($facultyId)
    {
        return $this->requestRepository
            ->with('storeFaculty.stuff')
            ->whereHas('storeFaculty', function ($has) use ($facultyId) {
                $has->where('faculty_id', '=', $facultyId);
            })
            ->findWhere([
                ['status', '=', 1],
                ['type', '=', Request::TYPE_FACULTY],
                ['kind_request', '=', Request::KIND_REQ_ONE]
            ]);
    }
    
    /**
     * Get request liquidation by faculty
     *
     * @param any $facultyId []
     *
     * @return mixed
     */
    public function getRequestAllLiquidationByFaculty($facultyId)
    {
        return $this->requestRepository
            ->with('storeFaculty.stuff')
            ->whereHas('storeFaculty', function ($has) use ($facultyId) {
                $has->where('faculty_id', '=', $facultyId);
            })
            ->findWhere([
                ['type', '=', Request::TYPE_FACULTY],
                ['kind_request', '=', Request::KIND_REQ_ONE]
            ]);
    }
    
    /**
     * Get request liquidation by room
     *
     * @param any $roomId []
     *
     * @return mixed
     */
    public function getRequestLiquidationByRoom($roomId)
    {
        return $this->requestRepository
            ->with('storeRoom.stuff')
            ->whereHas('storeRoom', function ($has) use ($roomId) {
                $has->where('room_id', '=', $roomId);
            })
            ->findWhere([
                ['status', '=', 1],
                ['type', '=', Request::TYPE_ROOM],
                ['kind_request', '=', Request::KIND_REQ_ONE]
            ]);
    }
    
    /**
     * Get request liquidation by room
     *
     * @return mixed
     */
    public function getRequestAllLiquidation()
    {
        return $this->requestRepository
            ->with(['storeRoom.stuff', 'storeFaculty.stuff'])
            ->findWhere([
                ['status', '=', 0],
                ['kind_request', '=', Request::KIND_REQ_ONE]
            ]);
    }
    
    /**
     * Delete request wait to liquidation of faculty
     *
     * @param any $id []
     *
     * @return void
     */
    public function deleteReqWaitLiquidation($id)
    {
        $req = $this->requestRepository->find($id);
        $req->delete();
    }
    
    /**
     * Delete request wait to liquidation of room
     *
     * @param any $id []
     *
     * @return void
     */
    public function deleteReqWaitLiquidationRoom($id)
    {
        $req = $this->requestRepository->find($id);
        $req->delete();
    }
}
