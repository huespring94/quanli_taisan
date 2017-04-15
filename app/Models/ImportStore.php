<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportStore extends Model
{
    protected $table = 'import_stores';
    
    protected $fillable = [
        'id',
        'date_import',
        'amount',
        'user_id',
        'store_id'
    ];
    
    /**
     * Get the store that owns the import store.
     * 
     * @return Store
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
    
    /**
     * Get the user that owns the import store.
     * 
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * Get detail import store by import store
     *
     * @return array
     */
    public function detailImportStores()
    {
        return $this->hasMany('App\Models\DetailImportStore');
    }
}
