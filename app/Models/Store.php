<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    
    public $timestamps = true;
    
    protected $fillable = [
        'id',
        'name'
    ];
    
     /**
     * Get the import stores for store.
     *
     * @return ImportStore
     */
    public function importStores()
    {
        return $this->hasMany('App\Models\ImportStore');
    }
}
