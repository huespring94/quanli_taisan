<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietNhapKho extends Model
{
    protected $table = 'chi_tiet_nhap_kho';
    
    protected $fillable = [
        'ma',
        'so_luong',
        'don_gia',
        'trang_thai',
        'ma_nhap_kho',
        'ma_vat_tu',
        'ma_nha_cung_cap'
    ];
}
