<?php
namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class BaseRepo extends BaseRepository
{
    /**
     * Update or create detail import store depend on quantity
     * 
     * @param array  $attributes []
     * @param array  $datas      []
     * @param string $columns    []
     *
     * @return mixed
     */
    public function updateOrCreateQuantity($attributes, $datas, $column)
    {
        $detailImport = $this->findByField($attributes, $datas);
        if (empty($detailImport->toArray())) {
            return $this->create($datas);
        }
        $quantity = $detailImport[0][$column] + $datas[$column];
        return $this->update([$column => $quantity], $detailImport[0]->id);
    }
}
