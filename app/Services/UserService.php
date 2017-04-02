<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\UserRepository;
use App\Criteria\RequestFilter;

class UserService extends BaseService
{
    /**
     * User repository
     *
     * @var userRepo
     */
    private $userRepo;
    
    /**
     * User service constructor.
     *
     * @param UserRepository $userRepo accountRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    
    /**
     * Get all users
     *
     * @return array
     */
    public function getAll()
    {
        return $this->userRepo->all();
    }
    
    public function createUser($data)
    {
        return $this->userRepo->create($data);
    }
    
    public function deleteSoftUser($id)
    {
        $now = Carbon::now();
        $this->userRepo->update(['delete_at' => $now->format(config('define.timestamp_format'))], $id);
    }
}
