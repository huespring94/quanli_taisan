<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DetailImportStore extends Model
{
    use SoftDeletes;
    
    protected $table = 'detail_import_stores';
    
    protected $fillable = [
        'id',
        'quantity',
        'quantity_start',
        'price_unit',
        'status_start',
        'status',
        'import_store_id',
        'stuff_id',
        'supplier_id'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the import store that owns the detail import store.
     *
     * @return ImportStore
     */
    public function importStore()
    {
        return $this->belongsTo(ImportStore::class);
    }
    
    /**
     * Get the stuff that owns the detail import store.
     *
     * @return Stuff
     */
    public function stuff()
    {
        return $this->belongsTo(Stuff::class, 'stuff_id', 'stuff_id');
    }
    
    /**
     * Get the store faculties for detail import store.
     *
     * @return StoreFaculty
     */
    public function storeFaculties()
    {
        return $this->hasMany(StoreFaculty::class);
    }
    
    /**
     * Get the liquidation for detail import store.
     *
     * @return Liquidation
     */
    public function liquidations()
    {
        return $this->hasMany(Liquidation::class, 'store_liquidation_id', 'id');
    }
}
