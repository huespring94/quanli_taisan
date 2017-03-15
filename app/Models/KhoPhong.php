<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhoPhong extends Model
{
    use SoftDeletes;
    
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
