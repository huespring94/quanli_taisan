<?php

namespace App\Services;

use App\Repositories\RequestRepository;
use App\Models\Request;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;

class RequestService
{
    protected $requestRepository;
    
    private $storeFacultyRepo;
    
    private $storeRoomRepo;

    /**
     * Constructor for request service
     *
     * @param RequestRepository $requestRepo []
     */
    public function __construct(
        RequestRepository $requestRepo,
        StoreFacultyRepository $storeFacultyRepo,
        StoreRoomRepository $storeRoomRepo)
    {
        $this->requestRepository = $requestRepo;
        $this->storeFacultyRepo = $storeFacultyRepo;
        $this->storeRoomRepo = $storeRoomRepo;
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
        if($requestInfo == null) {
            $requestInfo['quantity'] = 0;
        }
        if ($type == Request::TYPE_ROOM) {
            $storeRoom = $this->storeRoomRepo->findByField('store_room_id', $datas['store_type_id'])->first();
            if($datas['quantity'] > ($storeRoom->quantity - $requestInfo['quantity'])) {
                return null;
            } 
            $datas['type'] = Request::TYPE_ROOM;
        } else {
            $storeFac = $this->storeFacultyRepo->findByField('store_faculty_id', $datas['store_type_id'])->first();
            if($datas['quantity'] > ($storeFac->quantity - $requestInfo['quantity'])) {
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
    
    public function acceptRequest($requestId)
    {
        $request = $this->requestRepository->find($requestId);
        $request->status = 1;
        $request->save();
        if($request->type == Request::TYPE_FACULTY) {
            $this->storeFacultyRepo->deleteWhere(['store_faculty_id' => $request->store_type_id]);
        } else {
            $this->storeRoomRepo->deleteWhere(['store_room_id' => $request->store_type_id]);
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
     * 
     * @param type $facultyId []
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
}
