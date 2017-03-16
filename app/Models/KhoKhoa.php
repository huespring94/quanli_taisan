<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhoKhoa extends Model
{
    use SoftDeletes;
    
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
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
