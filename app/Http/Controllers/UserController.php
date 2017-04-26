<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    private $userService;
    
    /**
     * Contructor of user controller
     *
     * @param UserService $userService []
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    /**
     * Get timeline of author
     *
     * @return Reponse
     */
    public function getTimeline()
    {
        return view('auth.profile');
    }
}
