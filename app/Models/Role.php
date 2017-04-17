<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    public $timestamps = true;
    
    const ROLE_ADMIN = 'Admin';
    const ROLE_FACULTY = 'Khoa';
    const ROLE_ROOM = 'Phòng';
    const ROLE_ACCOUNTANT = 'Kế toán';

    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * Get users by role
     *
     * @return array
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
