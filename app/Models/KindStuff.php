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
    
    /**
     * Get the stuffs that owns the kind of stuff.
     *
     * @return array Stuff
     */
    public function stuffs()
    {
        return $this->hasMany(Stuff::class, 'kind_stuff_id', 'kind_stuff_id');
    }
}
