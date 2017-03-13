<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhoKhoa extends Model
{
    protected $table = 'kho_khoa';
    
    protected $fillable = [
        'ma',
        'ngay_nhap',
        'so_luong',
        'tinh_trang',
        'ma_khoa',
        'ma_nguoi_dung',
        'ma_chi_tiet_nhap_kho'
    ];
}
