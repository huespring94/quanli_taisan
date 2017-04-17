<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepo
{
    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    
    /**
     * Get only soft delete result
     *
     * @return array
     */
    public function getSoftDelete()
    {
        return $this->onlyTrashed()->get();
    }
    
    /**
     * Restore soft delete
     *
     * @return array
     */
    public function restoreSoftDelete()
    {
        return $this->model->restore();
    }
}
