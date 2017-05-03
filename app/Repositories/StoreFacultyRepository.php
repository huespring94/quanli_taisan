<?php

namespace App\Repositories;

use App\Models\StoreFaculty;

class StoreFacultyRepository extends BaseRepo
{

    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return StoreFaculty::class;
    }
    
    /**
     * Update status in store faculty
     *
     * @param DetailImportStore $detail []
     *
     * @return void
     */
    public function updateStatus($detail)
    {
        $storeFaculties = $this->findByField('detail_import_store_id', $detail->id);
        dd($storeFaculties);
        foreach ($storeFaculties as $storeFaculty) {
            $this->update(['status' => $detail->status], $storeFaculty->id);
        }
    }
}
