<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhoPhong extends Model
{
    protected $table = 'kho_phong';
    
    protected $fillable = [
        'ma',
        'ngay_nhap',
        'tinh_trang',
        'ma_phong',
        'ma_kho_khoa',
        'ma_nguoi_dung'
    ];
}
