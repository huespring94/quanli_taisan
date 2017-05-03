<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    protected $table = 'liquidations';
    
    protected $fillable = [
        'id',
        'date_liquidation',
        'quantity',
        'detail_import_store_id',
    ];
    
    /**
     * Get the detail import store that owns the liquidation.
     *
     * @return DetailImportStore
     */
    public function detailImportStore()
    {
        return $this->belongsTo(DetailImportStore::class)->withTrashed();
    }
}
