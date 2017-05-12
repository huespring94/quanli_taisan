<?php

namespace App\Repositories;

use App\Models\StoreFaculty;
use DB;
use App\Models\Liquidation;

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
    
    /**
     * Calculate quantity in table by stuff id
     *
     * @param any $stuffId   []
     * @param any $facultyId []
     *
     * @return int
     */
    public function getQuantityByFacultyStuffId($stuffId, $facultyId)
    {
        return \DB::table($this->model->getTable())
            ->where([['stuff_id', '=', $stuffId], ['faculty_id', '=', $facultyId]])
            ->sum('quantity');
    }
    
    /**
     * Get store faculty by year and faculty group by stuff
     *
     * @param any $facultyId []
     * @param int $year      []
     *
     * @return query
     */
    public function getStoreFacultyByYear($facultyId, $year)
    {
        return StoreFaculty::with(['stuff.supplier', 'stuff.kindStuff', 'faculty', 'detailImportStore'])
            ->where('faculty_id', '=', $facultyId)
            ->where('date_import', '>=', $year . '-01-01')
            ->where('date_import', '<=', $year . '-12-31')
            ->select('stuff_id', DB::raw('sum(quantity) as quantity, sum(quantity_start) as quantity_start'))
            ->groupBy('stuff_id');
    }
    
    /**
     * Get detail store faculty by year and faculty group by stuff
     *
     * @param any $facultyId []
     * @param int $year      []
     * @param any $stuffId   []
     *
     * @return mixed
     */
    public function getStoreFacultyByYearDetail($facultyId, $year, $stuffId)
    {
        return StoreFaculty::with(['storeRooms', 'stuff.supplier', 'stuff.kindStuff', 'faculty', 'detailImportStore'])
            ->where('faculty_id', '=', $facultyId)
            ->where('stuff_id', '=', $stuffId)
            ->where('date_import', '>=', $year . '-01-01')
            ->where('date_import', '<=', $year . '-12-31')
            ->withTrashed()
            ->get();
    }
    
    /**
     * Get liquidation in faculty
     *
     * @param any $facultyId []
     *
     * @return mixed
     */
    public function getLiquidation($facultyId)
    {
        return Liquidation::with(['detailImportStore.stuff', 'storeFaculty.stuff', 'storeRoom.stuff'])
            ->whereHas('storeFaculty', function($has) use ($facultyId) {
                $has->where('faculty_id', '=', $facultyId);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    /**
     * Get liquidation in faculty
     *
     * @param any $facultyId []
     *
     * @return mixed
     */
    public function getLiquidationTrashed($facultyId)
    {
        return StoreFaculty::with(['storeRooms', 'stuff.supplier', 'stuff.kindStuff', 'faculty', 'detailImportStore'])
            ->where('faculty_id', '=', $facultyId)
            ->orderBy('created_at', 'desc')
            ->onlyTrashed()
            ->get();
    }
}
