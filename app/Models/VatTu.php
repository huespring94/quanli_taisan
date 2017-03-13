<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VatTu extends Model
{
    protected $table = 'vat_tu';
    
    protected $fillable = [
        'ma',
        'ten',
        'mo_ta',
        'don_vi_tinh',
        'ma_loai_vat_tu',
        'ma_hao_mon'
    ];
}
