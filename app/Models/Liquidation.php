<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    protected $table = 'liquidations';
    
    protected $fillable = [
        'id',
        'date_liquidation',
        'quantity',
        'detail_import_store_id',
    ];
}
