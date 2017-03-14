<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhapKho extends Model
{
    protected $table = 'nhap_kho';
    
    protected $fillable = [
        'ma',
        'ngay_nhap',
        'so_tien',
        'ma_nguoi_dung',
        'ma_kho'
    ];
}
