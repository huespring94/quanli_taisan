<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StoreFaculty extends Model
{
    use SoftDeletes;
    
    protected $table = 'store_faculties';
    
    protected $fillable = [
        'id',
        'date_import',
        'quantity',
        'quantity_start',
//        'status',
        'faculty_id',
        'stuff_id',
//        'user_id',
        'detail_import_store_id'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the detail import store that owns the store faculty.
     *
     * @return DetailImportStore
     */
    public function detailImportStore()
    {
        return $this->belongsTo('App\Models\DetailImportStore')->withTrashed();
    }
    
    /**
     * Get the detail import store that owns the store faculty.
     *
     * @return Faculty
     */
    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty', 'faculty_id', 'faculty_id');
    }
    
    /**
     * Get the store rooms that chilren the store faculty.
     *
     * @return array StoreRoom
     */
    public function storeRooms()
    {
        return $this->hasMany(StoreRoom::class, 'store_faculty_id', 'store_faculty_id');
    }
    
    /**
     * Get the stuff that owns the store faculty.
     *
     * @return Stuff
     */
    public function stuff()
    {
        return $this->belongsTo(Stuff::class, 'stuff_id', 'stuff_id');
    }
    
    /**
     * Get the requests that chilren the store faculty.
     *
     * @return array Request
     */
    public function requests()
    {
        return $this->hasMany(Request::class, 'store_type_id', 'store_faculty_id');
    }
}
