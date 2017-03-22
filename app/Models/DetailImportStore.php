<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailImportStore extends Model
{
    protected $table = 'detail_import_stores';
    
    protected $fillable = [
        'id',
        'quantity',
        'price_unit',
        'status',
        'import_store_id',
        'stuff_id',
        'supplier_id'
    ];
}
