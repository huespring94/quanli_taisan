<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportStore extends Model
{
    protected $table = 'import_stores';
    
    protected $fillable = [
        'id',
        'date_import',
        'amount',
        'role_id',
        'store_id'
    ];
}
