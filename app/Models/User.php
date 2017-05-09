<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    
    protected $table = 'users';
    
    public $timestamps = true;
    
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'dob',
        'phone',
        'email',
        'address',
        'faculty_id',
        'room_id'
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
     * Get role that own user
     *
     * @return object
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Get faculty that own user
     *
     * @return object
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'faculty_id');
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
    
    /**
     * Get role that own user
     *
     * @return object
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }
}
