<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestTransfer extends Model
{
    protected $table = 'request_transfers';
    
    protected $fillable = [
        'id',
        'request_id',
        'store_room_id',
    ];
}
