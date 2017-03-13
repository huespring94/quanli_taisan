<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kho extends Model
{
    protected $table = 'kho';
    
    public $timestamps = true;
    
    protected $fillable = [
        'ma',
        'ten'
    ];
}
