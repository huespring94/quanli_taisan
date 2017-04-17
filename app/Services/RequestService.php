<?php

namespace App\Services;

use App\Repositories\RequestRepository;
use App\Repositories\RequestTransferRepository;

class RequestService
{
    protected $requestRepository;
    
    protected $reqTransferRepo;
    
    /**
     * Constructor for request service
     *
     * @param RequestRepository         $requestRepo     []
     * @param RequestTransferRepository $reqTransferRepo []
     */
    public function __construct(
        RequestRepository $requestRepo,
        RequestTransferRepository $reqTransferRepo
    ) {
        $this->requestRepository = $requestRepo;
        $this->reqTransferRepo = $reqTransferRepo;
    }
    
//    public function createRequest()
//    {
//    }
//    
//    public function createRequestTransfer()
//    {
//    }
//    
//    public function updateRequest();
//    public function updateRequestTransfer();
}
