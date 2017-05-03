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
     * @param string $column     []
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
    
    /**
     * Update or create detail import store depend on quantity
     *
     * @param array $attributes []
     * @param array $datas      []
     *
     * @return int
     */
    public function deleteOrCreate($attributes, $datas)
    {
        $detailImport = $this->findByField($attributes, $datas);
        if (!empty($detailImport->toArray())) {
            $this->deleteWhere($datas);
        }
        return $this->create($datas);
    }
    
    /**
     * Inserting records into the database table
     *
     * @param array $data Rows data
     *
     * @return bool
     */
    public function insertMany($data)
    {
        foreach ($data as $key => $value) {
            $value['updated_at'] = Carbon::now();
            $value['created_at'] = Carbon::now();
            $data[$key] = $value;
        }
        return \DB::table($this->model->getTable())->insert($data);
    }
    
    /**
     * Delete force, not delete soft
     *
     * @return void
     */
    public function forceDelete()
    {
        \DB::table($this->model->getTable())->forceDelete();
    }
    
    /**
     * Get all include soft deleted object
     *
     * @return void
     */
    public function withTrashed()
    {
        \DB::table($this->model->getTable())->withTrashed();
    }
}
