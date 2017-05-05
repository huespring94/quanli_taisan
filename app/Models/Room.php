<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    
    public $timestamps = true;
    
    protected $fillable = [
        'id',
        'name',
        'faculty_id',
    ];
    
    /**
     * Get the faculty that owns the room.
     *
     * @return Faculty
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'faculty_id');
    }
    
    /**
     * Get the store room that owns the room.
     *
     * @return array StoreRoom
     */
    public function storeRooms()
    {
        return $this->hasMany(StoreRoom::class, 'room_id', 'room_id');
    }
}
