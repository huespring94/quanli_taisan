<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StoreRoom extends Model
{
    use SoftDeletes;
    
    protected $table = 'store_rooms';
    
    const TT_MOI = 'moi';
    const TT_DA_SU_DUNG = 'da su dung';
    
    protected $fillable = [
        'id',
        'date_import',
        'stuff_id',
        'status',
        'room_id',
        'quantity',
        'quantity_start',
        'store_faculty_id',
        'user_id'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the store faculty that owns the store room.
     *
     * @return StoreFaculty
     */
    public function storeFaculty()
    {
        return $this->belongsTo(StoreFaculty::class, 'store_faculty_id', 'store_faculty_id');
    }
    
    /**
     * Get the faculty that owns the store room.
     *
     * @return Faculty
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'faculty_id');
    }
    
    /**
     * Get the stuff that owns the store room.
     *
     * @return Stuff
     */
    public function stuff()
    {
        return $this->belongsTo(Stuff::class, 'stuff_id', 'stuff_id');
    }
}
