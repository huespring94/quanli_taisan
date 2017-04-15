<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailImportStore extends Model
{
    protected $table = 'detail_import_stores';
    
    protected $fillable = [
        'id',
        'quantity',
        'price_unit',
        'status',
        'import_store_id',
        'stuff_id',
        'supplier_id'
    ];
    
    /**
     * Get the import store that owns the detail import store.
     * 
     * @return ImportStore
     */
    public function importStore()
    {
        return $this->belongsTo('App\Models\ImportStore');
    }
    
    /**
     * Get the stuff that owns the detail import store.
     * 
     * @return Stuff
     */
    public function stuff()
    {
        return $this->belongsTo('App\Models\Stuff', 'stuff_id', 'stuff_id');
    }
}
