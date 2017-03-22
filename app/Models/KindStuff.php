<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KindStuff extends Model
{
    protected $table = 'kind_stuffs';
    
    protected $fillable = [
        'id',
        'name',
        'description',
    ];
}
