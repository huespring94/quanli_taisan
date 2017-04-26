<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $table = 'stuffs';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'kind_stuff_id',
        'atrophy_id'
    ];
    
    /**
     * Get the detail import store that owns the stuff.
     *
     * @return DetailImportStore
     */
    public function detailImportStores()
    {
        return $this->hasMany(DetailImportStore::class);
    }
    
    /**
     * Get the kind of stuff that owns the stuff.
     *
     * @return KindStuff
     */
    public function kindStuff()
    {
        return $this->belongsTo(KindStuff::class, 'kind_stuff_id', 'kind_stuff_id');
    }
}
