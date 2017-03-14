<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    protected $table = 'nha_cung_cap';
    
    protected $fillable = [
        'ma',
        'ten',
        'dia_chi',
        'mo_ta',
    ];
}
