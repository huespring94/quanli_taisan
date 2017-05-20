<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportStuffService;
use App\Services\StuffFacultyService;
use App\Services\LiquidationService;
use App\Services\StatisticalService;
use App\Services\FacultyRoomService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExportExcelController extends Controller
{

    private $excel;
    private $importStuffService;
    private $stuffFacService;
    private $liquiService;
    private $statisService;
    private $facRoomService;

    /**
     * Constructor of export excel controller
     *
     * @param Excel               $excel              []
     * @param ImportStuffService  $importStuffService []
     * @param StuffFacultyService $stuffFacService    []
     * @param LiquidationService  $liquiService       []
     * @param StatisticalService  $statisService      []
     * @param FacultyRoomService  $facRoomService     []
     */
    public function __construct(
        Excel $excel,
        ImportStuffService $importStuffService,
        StuffFacultyService $stuffFacService,
        LiquidationService $liquiService,
        StatisticalService $statisService,
        FacultyRoomService $facRoomService
    ) {
    
        $this->excel = $excel;
        $this->importStuffService = $importStuffService;
        $this->stuffFacService = $stuffFacService;
        $this->liquiService = $liquiService;
        $this->statisService = $statisService;
        $this->facRoomService = $facRoomService;
    }

    /**
     * Download excel for detail import store
     *
     * @param any $id []
     *
     * @return void
     */
    public function downloadDetailImportStoreById($id)
    {
        $importStore = $this->importStuffService->getImportStoreById($id);
        return Excel::create('Đại học bách khoa', function ($excel) use ($id, $importStore) {
                $excel->sheet('Kho-' . $importStore->store->name, function ($sheet) use ($id, $importStore) {
                    $sheet->setHeight(4, 20);
                    $sheet->setAutoSize(false);
                    $sheet->cell('C4', function ($cell) {
                        $cell->setFont(array(
                            'family' => 'Times New Roman',
                            'size' => '16',
                            'bold' => false
                        ));
                        $cell->setValue('PHIẾU NHẬP TÀI SẢN VÀO KHO');
                    });
                    $sheet->setFontSize(10);
                    $detailImports = $this->importStuffService->getDetailImportStoreByIStoreId($id);
                    $amount = $this->importStuffService->countAmountImportStore($id);

                    $sheet->row(6, array('Kho hàng', $importStore->store->name));
                    $sheet->rows(array(
                        array('Ngày nhập', $importStore->date_import),
                        array('Mã nhập kho', $importStore->id),
                        array('Người nhập', $importStore->user->lastname . ' ' . $importStore->user->firstname),
                        array('Tổng tiền', number_format($amount))
                    ));
                    $sheet->cells('A13:H13', function ($cells) {
                        $cells->setBackground('#00ffff');
                    });
                    $sheet->cells('A5:Z100', function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->row(13, config('structure.title'));
                    foreach ($detailImports as $key => $data) {
                        $importedDatas = array($key + 1, $data->stuff_id,
                            $data->stuff->name, $data->stuff->supplier->name, $data->quantity, $data->price_unit, number_format($data->quantity * $data->price_unit), $data->status);
                        $sheet->row($key + 14, $importedDatas);
                    }
                });
        })->download('xls');
    }

    /**
     * Download statistic
     *
     * @return void
     */
    public function downloadLiquidation()
    {
        $title = 'DANH SÁCH TÀI SẢN THANH LÍ';
        $liquidations = $this->liquiService->getAllLiquidation();
        $this->liquidation($liquidations, $title);
    }
    
    /**
     * Download statistic
     *
     * @return void
     */
    public function downloadLiquidationOwnFaculty()
    {
        $faculty = $this->facRoomService->getFacultyById(auth()->user()->faculty_id);
        $title = 'DANH SÁCH TÀI SẢN THANH LÍ KHOA '. strtoupper($faculty->name);
        $titleSheet = 'Khoa-' . $faculty->faculty_id;
        $liquidations = $this->liquiService->getAllLiquidationFaculty();
        $this->liquidation($liquidations, $title, $titleSheet);
    }

    /**
     * Use for export excel for liquidation
     *
     * @param mixed  $liquidations []
     * @param string $title        []
     * @param string $titleSheet   []
     *
     * @return void
     */
    public function liquidation($liquidations, $title, $titleSheet = 'DHBK')
    {
        return Excel::create('ThanhLi', function ($excel) use ($liquidations, $title, $titleSheet) {
                $excel->sheet($titleSheet, function ($sheet) use ($liquidations, $title) {
                    $sheet->setHeight(4, 20);
                    $sheet->setAutoSize(false);
                    $sheet->cell('C4', function ($cell) use ($title) {
                        $cell->setFont(array(
                            'family' => 'Times New Roman',
                            'size' => '15',
                            'bold' => false
                        ));
                        $cell->setValue($title);
                    });
                    $sheet->setFontSize(10);

                    $sheet->cells('A7:H7', function ($cells) {
                        $cells->setBackground('#00ffff');
                    });
                    $sheet->cells('A5:Z100', function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->row(7, config('structure.liquidation'));
                    foreach ($liquidations as $key => $liquidation) {
                        if ($liquidation->store_type == config('constant.type_school')) {
                            $id = $liquidation->detail_import_store_id;
                        } else {
                            $id = $liquidation->store_liquidation_id;
                        }
                        $dateLiqui = $liquidation->date_liquidation;
                        $quantity = $liquidation->quantity;
                        if ($liquidation->store_type == config('constant.type_faculty')) {
                            $address = $liquidation->store_type . '-' . $liquidation->storeFaculty->faculty->name;
                            $dateImport = $liquidation->storeFaculty->date_import;
                            $nameStuff = $liquidation->storeFaculty->stuff->name;
                            $rate = $liquidation->storeFaculty->detailImportStore->status;
                        } elseif ($liquidation->store_type == config('constant.type_room')) {
                            $address = $liquidation->store_type . '-' . $liquidation->storeRoom->room->name;
                            $dateImport = $liquidation->storeRoom->date_import;
                            $nameStuff = $liquidation->storeRoom->stuff->name;
                            $rate = $liquidation->storeRoom->storeFaculty->detailImportStore->status;
                        } else {
                            $address = $liquidation->store_type . '-' . $liquidation->detailImportStore->importStore->store->name;
                            $dateImport = $liquidation->detailImportStore->importStore->date_import;
                            $nameStuff = $liquidation->detailImportStore->stuff->name;
                            $rate = $liquidation->detailImportStore->status;
                        }
                        $importedDatas = array($key + 1,
                            $id,
                            $dateLiqui,
                            $quantity,
                            $address,
                            $dateImport,
                            $nameStuff,
                            $rate,);
                        $sheet->row($key + 8, $importedDatas);
                    }
                });
        })->download('xls');
    }

    /**
     * Download detail impport
     *
     * @return void
     */
    public function downloadDetailImport()
    {
        $details = $this->stuffFacService->getAllDetail();
        return Excel::create('Đại học bách khoa', function ($excel) use ($details) {
                $excel->sheet('Kho', function ($sheet) use ($details) {
                    $sheet->setHeight(4, 20);
                    $sheet->setAutoSize(false);
                    $sheet->cell('C4', function ($cell) {
                        $cell->setFont(array(
                            'family' => 'Times New Roman',
                            'size' => '16',
                            'bold' => false
                        ));
                        $cell->setValue('DANH SÁCH TÀI SẢN TỒN KHO');
                    });
                    $sheet->setFontSize(10);
                    $sheet->cells('A6:K6', function ($cells) {
                        $cells->setBackground('#00ffff');
                    });
                    $sheet->cells('A5:Z100', function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->row(6, config('structure.list-detail'));
                    foreach ($details as $key => $data) {
                        $importedDatas = array($key + 1, $data->id, $data->importStore->date_import,
                            $data->stuff->name, $data->stuff->supplier->name, $data->importStore->store->name, $data->quantity, number_format($data->quantity * $data->price_unit), $data->status);
                        $sheet->row($key + 7, $importedDatas);
                    }
                });
        })->download('xls');
    }

    /**
     * Download statistic
     *
     * @param \App\Http\Controllers\Request $request []
     *
     * @return void
     */
    public function downloadStatistic(Request $request)
    {
        $data = $request->all();
        if (empty($data['year'])) {
            $data['year'] = Carbon::now()->year;
        }
        if (!isset($data['faculty_id'])) {
            $data['faculty_id'] = auth()->user()->faculty_id;
        }
        return Excel::create('ThongKe', function ($excel) use ($data) {
                $excel->sheet($data['year'].'-'.(isset($data['room_id']) ? $data['faculty_id'] : $data['room_id']), function ($sheet) use ($data) {
                    $sheet->setHeight(4, 20);
                    $sheet->setAutoSize(false);
                    $sheet->cell('C4', function ($cell) use ($data) {
                        $cell->setFont(array(
                            'family' => 'Times New Roman',
                            'size' => '16',
                            'bold' => false
                        ));
                        $type = !isset($data['room_id']) ? 'KHOA' : 'PHÒNG';
                        $cell->setValue('THỐNG KÊ TÀI SẢN '. $type .' NĂM '. $data['year']);
                    });
                    $sheet->setFontSize(10);
                    if (!isset($data['room_id'])) {
                        $exportDatas = $this->statisService->getStoreFacultyByYear($data['year'], $data['faculty_id']);
                        $sheet->row(6, array('Khoa ', $this->facRoomService->getFacultyById($data['faculty_id'])->name));
                    } else {
                        $exportDatas = $this->statisService->getStoreRoomByYearRoom($data['year'], $data['room_id']);
                        $sheet->row(6, array('Khoa', $this->facRoomService->getFacultyByRoom($data['room_id'])->name));
                        $sheet->row(7, array('Phòng', $this->facRoomService->getRoomById($data['room_id'])->name));
                    }
                    
                    $sheet->cells('A9:I9', function ($cells) {
                        $cells->setBackground('#00ffff');
                    });
                    $sheet->cells('A5:Z100', function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->row(9, config('structure.statistic'));
                    foreach ($exportDatas as $key => $exportData) {
                        if (!isset($data['room_id'])) {
                            $id = $exportData->store_faculty_id;
                            $status = $exportData->detailImportStore->status;
                        } else {
                            $id = $exportData->store_room_id;
                            $status = $exportData->storeFaculty->detailImportStore->status;
                        }
                        $stuff = $exportData->stuff->name;
                        $supplier = $exportData->stuff->supplier->name;
                        $useYear = explode('-', $exportData->date_import)[0];
                        $quantityStart = $exportData->quantity_start;
                        $quantity = $exportData->quantity;
                        $liquidation = $exportData->liquidation;
                        $importedDatas = array($key + 1,
                            $id,
                            $stuff,
                            $supplier,
                            $useYear,
                            $quantityStart,
                            $quantity,
                            $liquidation,
                            $status
                        );
                        $sheet->row($key + 10, $importedDatas);
                    }
                });
        })->download('xls');
    }
    
    /**
     * Download list of stuff for faculty or room
     *
     * @param \App\Http\Controllers\Request $request []
     *
     * @return void
     */
    public function downloadListStuff(Request $request)
    {
        $data = $request->all();
        if (!isset($data['faculty_id'])) {
            $data['faculty_id'] = auth()->user()->faculty_id;
        }
        if (!isset($data['room_id'])) {
            $list = $this->stuffFacService->getImportFacultyByFaculty($data['faculty_id']);
        } else {
            $list = $this->stuffFacService->getImportRoomAllByRoom($data['room_id']);
        }
        if (!isset($data['room_id'])) {
            $title = 'DANH SÁCH TÀI SẢN KHOA '. strtoupper($this->facRoomService->getFacultyById($data['faculty_id'])->name);
            $sheetName = 'Khoa-'. $data['faculty_id'];
        } else {
            $title = 'DANH SÁCH TÀI SẢN PHÒNG '. strtoupper($this->facRoomService->getRoomById($data['room_id'])->name);
            $sheetName = 'Phong-'.$data['room_id'];
        }
        return Excel::create('DanhSachTaiSan', function ($excel) use ($list, $title, $sheetName) {
                $excel->sheet($sheetName, function ($sheet) use ($list, $title) {
                    $sheet->setHeight(4, 20);
                    $sheet->setAutoSize(false);
                    $sheet->cell('C4', function ($cell) use ($title) {
                        $cell->setFont(array(
                            'family' => 'Times New Roman',
                            'size' => '15',
                            'bold' => false
                        ));
                        $cell->setValue($title);
                    });
                    $sheet->setFontSize(10);
                    $sheet->cells('A6:I6', function ($cells) {
                        $cells->setBackground('#00ffff');
                    });
                    $sheet->cells('A5:Z100', function ($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->row(6, config('structure.list'));
                    foreach ($list as $key => $data) {
                        if (!isset($data->store_room_id)) {
                            $id = $data->store_faculty_id;
                            $amount = number_format($data->quantity * $data->detailImportStore->price_unit);
                            $status = $data->detailImportStore->status;
                        } else {
                            $id = $data->store_room_id;
                            $amount = number_format($data->quantity * $data->storeFaculty->detailImportStore->price_unit);
                            $status = $data->storeFaculty->detailImportStore->status;
                        }
                        $date = $data->date_import;
                        $stuff = $data->stuff->name;
                        $supplier = $data->stuff->supplier->name;
                        $quantity = $data->quantity;
                        
                        if (isset($data->liquidation_quantity)) {
                            if ($data->liquidation_status) {
                                $note = 'Đã thanh lí (' . $data->liquidation_quantity . ')';
                            } else {
                                $note = 'Đang chờ (' . $data->liquidation_quantity . ')';
                            }
                        } else {
                            $note = '';
                        }
                        $importedDatas = array($key + 1,
                            $id,
                            $date,
                            $stuff,
                            $supplier,
                            $quantity,
                            $amount,
                            $status,
                            $note
                            );
                        $sheet->row($key + 7, $importedDatas);
                    }
                });
        })->download('xls');
    }
}
