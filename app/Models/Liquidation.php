<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    protected $table = 'liquidations';
    
    const TYPE_FACULTY = 'Khoa';
    const TYPE_ROOM = 'Phòng';
    const TYPE_SCHOOL = 'Trường';
    
    protected $fillable = [
        'id',
        'date_liquidation',
        'quantity',
        'detail_import_store_id',
        'store_liquidation_id',
        'store_type'
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
    
    /**
     * Get the detail import store that owns the liquidation.
     *
     * @return DetailImportStore
     */
    public function storeFaculty()
    {
        return $this->belongsTo(StoreFaculty::class, 'store_liquidation_id', 'store_faculty_id')->withTrashed();
    }
    
    /**
     * Get the detail import store that owns the liquidation.
     *
     * @return DetailImportStore
     */
    public function storeRoom()
    {
        return $this->belongsTo(StoreRoom::class, 'store_liquidation_id', 'store_room_id')->withTrashed();
    }
}
