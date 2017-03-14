<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    protected $table = 'phan_quyen';
    
    public $timestamps = true;
    
    const QUYEN_KHOA = 'Khoa';
    const QUYEN_PHONG = 'Phong';
    const QUYEN_KE_TOAN = 'Ke toan';
    const QUYEN_PHONG_CSVC = 'Truong phong CSVC';
    
    protected $fillable = [
        'ma',
        'ten'
    ];
}
