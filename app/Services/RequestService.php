<?php

namespace App\Services;

use App\Repositories\RequestRepository;
use App\Repositories\RequestTransferRepository;

class RequestService
{
    protected $requestRepository;
    
    protected $requestTransferRepository;
    
    public function __construct(
        RequestRepository $requestRepo,
        RequestTransferRepository $requestTransferRepo)
    {
        $this->requestRepository = $requestRepo;
        $this->requestTransferRepository = $requestTransferRepo;
    }
    
    public function createRequest()
    {
        
    }
    
    public function createRequestTransfer()
    {
        
    }
    
    public function updateRequest();
    public function updateRequestTransfer(); 
}
