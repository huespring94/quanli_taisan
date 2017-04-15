<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StoreFaculty extends Model
{
    use SoftDeletes;
    
    protected $table = 'store_faculties';
    
    const TT_MOI = 'moi';
    const TT_DA_SU_DUNG = 'da su dung';
    
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
}
