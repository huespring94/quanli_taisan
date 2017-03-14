<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiVatTu extends Model
{
    protected $table = 'loai_vat_tu';
    
    protected $fillable = [
        'ma',
        'ten',
        'mo_ta',
    ];
}
