<?php

namespace App\Repositories;

use App\Models\DetailImportStore;

class DetailImportStoreRepository extends BaseRepo
{

    /**
     * To telling repository what model class you want to use
     *
     * @return string
     */
    public function model()
    {
        return DetailImportStore::class;
    }

    /**
     * Update or create detail import store depend on quantity
     * 
     * @param array  $attributes []
     * @param array  $datas      []
     * @param string $columns    []
     *
     * @return mixed
     */
    public function updateOrCreateQuantity($attributes, $datas, $columns)
    {
        $detailImport = $this->findByField($attributes, $datas);
        if (empty($detailImport->toArray())) {
            return $this->create($datas);
        }
        $quantity = $detailImport[0][$columns] + $datas[$columns];
        return $this->update([$columns => $quantity], $detailImport[0]->id);
    }
}
