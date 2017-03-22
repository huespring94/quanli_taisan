<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'facuties';
    
    public $timestamps = true;
    
    protected $fillable = [
        'id',
        'name',
        'faculty_id',
    ];
}
