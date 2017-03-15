<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NguoiDung extends Model
{
    use SoftDeletes;
    
    protected $table = 'nguoi_dung';
    
    public $timestamps = true;
    
    protected $fillable = [
        'ma',
        'mat_khau',
        'ten',
        'ho',
        'ngay_sinh',
        'dien_thoai',
        'email',
        'dia_chi'
    ];
    
    protected $hidden = [
        'mat_khau',
        'remember_token'
    ];
    
    protected $guarded = [
        'ma_phan_quyen'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}