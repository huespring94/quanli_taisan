<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    protected $table = 'phong';
    
    public $timestamps = true;
    
    protected $fillable = [
        'ma',
        'ten',
        'ma_khoa',
    ];
}
