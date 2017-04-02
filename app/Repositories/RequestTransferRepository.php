<?php

namespace App\Repositories;

use App\Models\RequestTransfer;

class RequestTransferRepository
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return RequestTransfer::class;
    }
}
