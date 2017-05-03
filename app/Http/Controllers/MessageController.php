<?php

namespace App\Http\Controllers;

use App\Services\MessageService;

class MessageController extends Controller
{
    private $messageService;
    
    /**
     * Constructor message controller
     *
     * @param MessageService $messageService []
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    
    /**
     * Get amount expire stuff
     *
     * @return int
     */
    public function getAmountExpireStuff()
    {
        return $this->messageService->getAmountExpireStuff();
    }
}
