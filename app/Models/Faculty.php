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
        return $this->hasMany('App\Models\StoreFaculty');
    }
}
