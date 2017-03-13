<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinhTrang extends Model
{
    protected $table = 'tinh_trang';
    
    protected $fillable = [
        'ma',
        'ma_kho_phong',
        'hu_hai_hien_tai',
        'tong_hu_hai',
        'thoi_gian',
        'ghi_chu'
    ];
}
