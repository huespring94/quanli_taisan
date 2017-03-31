<?php

namespace App\Repositories;

use App\Models\Liquidation;

class LiquidationRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return Liquidation::class;
    }
}
