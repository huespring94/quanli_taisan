<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';
    
    protected $fillable = [
        'id',
        'name'
    ];
    
    /**
     * Get the store faculties for faculty.
     *
     * @return StoreFaculty
     */
    public function storeFaculties()
    {
        return $this->hasMany(StoreFaculty::class);
    }
    
    /**
     * Get the room that chilren the faculty.
     *
     * @return array StoreRoom
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'faculty_id', 'faculty_id');
    }
}
