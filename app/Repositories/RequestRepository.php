<?php

namespace App\Repositories;

use App\Models\Request;

class RequestRepository
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Request::class;
    }
}
