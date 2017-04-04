<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    
    protected $table = 'users';
    
    public $timestamps = true;
    
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'dob',
        'phone',
        'email',
        'address'
    ];
    
    protected $hidden = [
        'password',
        'remember_token'
    ];
    
    protected $guarded = [
        'role_id'
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Lay phan quyen theo nguoi dung
     *
     * @return object
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    
    /**
     * Get the import stores for user.
     * 
     * @return ImportStore
     */
    public function importStores()
    {
        return $this->hasMany('App\Models\ImportStore');
    }
}
