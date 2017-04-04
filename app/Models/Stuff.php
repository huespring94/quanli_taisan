<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $table = 'stuffs';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'kind_stuff_id',
        'atrophy_id'
    ];
}
