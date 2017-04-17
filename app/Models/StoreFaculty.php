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
        'status',
        'faculty_id',
        'user_id',
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
        return $this->belongsTo('App\Models\DetailImportStore');
    }
    
    /**
     * Get the detail import store that owns the store faculty.
     *
     * @return Faculty
     */
    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }
}
