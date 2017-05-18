<?php

namespace App\Services;

use App\Repositories\LiquidationRepository;
use App\Repositories\DetailImportStoreRepository;
use App\Repositories\StoreFacultyRepository;
use App\Repositories\StoreRoomRepository;
use Carbon\Carbon;
use App\Models\StoreFaculty;
use DB;

class StatisticalService extends BaseService
{
    private $liquidationRepo;
    
    private $detailISRepo;
    
    private $storeFacRepo;
    
    private $storeRoomRepo;

    /**
     * Constructor of statistical service
     *
     * @param LiquidationRepository       $liquidationRepo []
     * @param DetailImportStoreRepository $detailISRepo    []
     * @param StoreFacultyRepository      $storeFacRepo    []
     * @param StoreRoomRepository         $storeRoomRepo   []
     */
    public function __construct(
        LiquidationRepository $liquidationRepo,
        DetailImportStoreRepository $detailISRepo,
        StoreFacultyRepository $storeFacRepo,
        StoreRoomRepository $storeRoomRepo
    ) {
    
        $this->liquidationRepo = $liquidationRepo;
        $this->detailISRepo = $detailISRepo;
        $this->storeFacRepo = $storeFacRepo;
        $this->storeRoomRepo = $storeRoomRepo;
    }

    /**
     * Get smallest year of store faculty by faculty id
     *
     * @param any $facultyId []
     *
     * @return Date
     */
    public function getMiniYearStoreFacultyByFaculty($facultyId)
    {
        return $this->storeFacRepo->orderBy('date_import')
            ->findByField('faculty_id', $facultyId)
            ->first()->date_import;
    }
    
    /**
     * Get largest year of store faculty by faculty id
     *
     * @param any $facultyId []
     *
     * @return Date
     */
    public function getMaxiYearStoreFacultyByFaculty($facultyId)
    {
        return $this->storeFacRepo->orderBy('date_import', 'desc')
            ->findByField('faculty_id', $facultyId)
            ->first()->date_import;
    }
    
    /**
     * Get year store faculty by faculty id
     *
     * @param any $facultyId []
     *
     * @return array
     */
    public function getYearStoreFacultyByFaculty($facultyId)
    {
        $max = Carbon::parse($this->getMaxiYearStoreFacultyByFaculty($facultyId))->year;
        $now = Carbon::now()->year;
        if ($now > $max) {
            $max = $now;
        }
        return [
            'max' => $max,
            'min' => Carbon::parse($this->getMiniYearStoreFacultyByFaculty($facultyId))->year,
            'now' => $now
        ];
    }

    /**
     * Get store faculty by year
     *
     * @param int $year []
     *
     * @return mixed
     */
    public function getStoreFacultyByYear($year, $facultyId)
    {
        $importExports = $this->storeFacRepo->getStoreFacultyByYear($facultyId, $year);
        $liquidations = $this->liquidationRepo->getLiquidationByYear()->pluck('quantity', 'store_liquidation_id')->all();
        foreach ($importExports as $importExport) {
            if (in_array($importExport->store_faculty_id, array_keys($liquidations))) {
                $importExport['liquidation'] = $liquidations[$importExport->store_faculty_id];
            }
        }
        return $importExports;
    }
    
    /**
     * Get store room by year room
     *
     * @param int $year   []
     * @param any $roomId []
     *
     * @return mixed
     */
    public function getStoreRoomByYearRoom($year, $roomId)
    {
        $importExports = $this->storeRoomRepo->getStoreFacultyByYearRoom($roomId, $year);
        $liquidations = $this->liquidationRepo->getLiquidationByYear()->pluck('quantity', 'store_liquidation_id')->all();
        foreach ($importExports as $importExport) {
            if (in_array($importExport->store_room_id, array_keys($liquidations))) {
                $importExport['liquidation'] = $liquidations[$importExport->store_room_id];
            }
        }
        return $importExports;
    }
    
    /**
     * Get store faculty by store faculty id
     *
     * @param any $facultyId []
     * @param int $year      []
     * @param any $stuffId   []
     *
     * @return mixed
     */
    public function getStoreFacultyByStoreFaculty($facultyId, $year, $stuffId)
    {
        return $this->storeFacRepo->getStoreFacultyByYearDetail($facultyId, $year, $stuffId);
    }
}
