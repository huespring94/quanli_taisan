<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HaoMonVoHinh extends Model
{
    protected $table = 'hao_mon_vo_hinh';

    protected $fillable = [
        'ma',
        'ten',
        'mo_ta',
        'ty_le_hao_mon'
     ];
}
