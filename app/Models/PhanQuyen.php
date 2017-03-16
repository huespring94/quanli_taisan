<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    protected $table = 'phan_quyen';
    
    public $timestamps = true;
    
    const QUYEN_KHOA = 'Quan li khoa';
    const QUYEN_PHONG = 'Quan li phong';
    const QUYEN_KE_TOAN = 'Ke toan';
    
    protected $fillable = [
        'ma',
        'ten'
    ];
    
    /**
     * Lay nguoi dung theo phan quyen
     */
    public function nguoiDungs()
    {
        return $this->hasMany('App\Models\NguoiDung');
    }
}
