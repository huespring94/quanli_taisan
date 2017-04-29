<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    
    protected $fillable = [
        'id',
        'name',
        'address',
        'description',
    ];
    
    /**
     * Get supplier that owns the stuffs.
     *
     * @return Stuff
     */
    public function stuffs()
    {
        return $this->hasMany(Stuff::class, 'supplier_id', 'supplier_id');
    }
}
