<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    public $timestamps = true;
    
    const QUYEN_KHOA = 'Quan li khoa';
    const QUYEN_PHONG = 'Quan li phong';
    const QUYEN_KE_TOAN = 'Ke toan';

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
