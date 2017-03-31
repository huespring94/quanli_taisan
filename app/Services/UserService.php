<?php

namespace App\Services;

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
}
