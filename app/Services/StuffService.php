<?php

namespace App\Services;

class StuffService
{
    
    private $stuffRepo;
    
    private $importStoreRepo;
    
        public function createActivity($data)
    {
        return $this->activityRepo->create($data);
    }
}
