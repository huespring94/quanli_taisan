<?php

namespace App\Models;

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
        'status',
        'room_id',
        'store_faculty_id',
        'user_id'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}