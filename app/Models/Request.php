<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    
    const TYPE_FACULTY = 'Khoa';
    const TYPE_ROOM = 'Phòng';

    const KIND_REQ_ONE = 'Thanh lí';
    const KIND_REQ_TWO = 'Điều chuyển';

    protected $fillable = [
        'id',
        'store_type_id',
        'type',
        'quantity',
        'kind_request',
        'status',
        'note',
    ];
    
    /**
     * Get the store faculty that owns the request.
     *
     * @return StoreFaculty
     */
    public function storeFaculty()
    {
        return $this->belongsTo(StoreFaculty::class, 'store_type_id', 'store_faculty_id');
    }
    
    /**
     * Get the store room that owns the request.
     *
     * @return StoreRoom
     */
    public function storeRoom()
    {
        return $this->belongsTo(StoreRoom::class, 'store_type_id', 'store_room_id');
    }
}
