<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhoKhoa extends Model
{
    protected $table = 'kho_khoa';
    
    const TT_MOI = 'moi';
    const TT_DA_SU_DUNG = 'da su dung';
    
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
