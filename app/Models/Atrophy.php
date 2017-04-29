<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atrophy extends Model
{
    protected $table = 'atrophies';

    protected $fillable = [
        'id',
        'name',
        'description',
        'atrophy_rate'
    ];
    
    /**
     * Get the atrophy that owns the stuff.
     *
     * @return array
     */
    public function stuffs()
    {
        return $this->hasMany(Stuff::class);
    }
}
