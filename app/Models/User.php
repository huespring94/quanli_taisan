<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
}
