<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportStuffService;
use App\Services\StuffFacultyService;
use App\Services\LiquidationService;

class ExportExcelController extends Controller
{

    private $excel;
    private $importStuffService;
    private $stuffFacService;
    private $liquiService;

    public function __construct(
        Excel $excel, 
        ImportStuffService $importStuffService, 
        StuffFacultyService $stuffFacService,
        LiquidationService $liquiService)
    {
        $this->excel = $excel;
        $this->importStuffService = $importStuffService;
        $this->stuffFacService = $stuffFacService;
        $this->liquiService = $liquiService;
    }

    /**
     * Download excel for detail import store
     *
     * @var array
     */
    public function downloadDetailImportStoreById($id)
    {
        $importStore = $this->importStuffService->getImportStoreById($id);
        return Excel::create('Đại học bách khoa', function($excel) use ($id, $importStore) {
                $excel->sheet('Kho-' . $importStore->store->name, function($sheet) use ($id, $importStore) {
                    $sheet->setHeight(4, 20);
                    $sheet->setAutoSize(false);
                    $sheet->cell('C4', function($cell) {
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
                    $sheet->cells('A13:G13', function($cells) {
                        $cells->setBackground('#00ffff');
                    });
                    $sheet->cells('A5:Z100', function($cells) {
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
    public function downloadStatistic()
    {
        $title = 'DANH SÁCH TÀI SẢN THANH LÍ';
        $liquidations = $this->liquiService->getAllLiquidation();
        $this->statistic($liquidations, $title);
    }
    
    /**
     * Use for export excel for liquidation
     *
     * @param mixed $liquidations
     *
     * @return void
     */
    public function statistic($liquidations, $title)
    {
        return Excel::create ('Đại học bách khoa', function($excel) use ($title) {
                $excel->sheet ('ThanhLi', function($sheet) use($title) {
                    $sheet->setHeight (4, 20);
                    $sheet->setAutoSize (false);
                    $sheet->cell ('C4', function($cell) use($title){
                        $cell->setFont (array(
                            'family' => 'Times New Roman',
                            'size' => '16',
                            'bold' => false
                        ));
                        $cell->setValue ($title);
                    });
                    $sheet->setFontSize (10);

                    $sheet->cells ('A7:H7', function($cells) {
                        $cells->setBackground ('#00ffff');
                    });
                    $sheet->cells ('A5:Z100', function($cells) {
                        $cells->setAlignment ('center');
                    });
                    $sheet->row (7, config ('structure.statistic'));
                    $datas = [];
                    foreach ($liquidations as $key => $liquidation) {
                        if ($liquidation->store_type == config ('constant.type_school')) {
                            $id = $liquidation->detail_import_store_id;
                        } else {
                            $id = $liquidation->store_liquidation_id;
                        }
                        $dateLiqui = $liquidation->date_liquidation;
                        $quantity = $liquidation->quantity;
                        if ($liquidation->store_type == config ('constant.type_faculty')) {
                            $address = $liquidation->store_type.'-'.$liquidation->storeFaculty->faculty->name;
                            $dateImport = $liquidation->storeFaculty->date_import;
                            $nameStuff = $liquidation->storeFaculty->stuff->name;
                            $rate = $liquidation->storeFaculty->detailImportStore->status;
                        } elseif ($liquidation->store_type == config ('constant.type_room')) {
                            $address = $liquidation->store_type.'-'.$liquidation->storeRoom->room->name;
                            $dateImport = $liquidation->storeRoom->date_import;
                            $nameStuff = $liquidation->storeRoom->stuff->name;
                            $rate = $liquidation->storeRoom->storeFaculty->detailImportStore->status;
                        } else {
                            $address = $liquidation->store_type.'-'.$liquidation->detailImportStore->importStore->store->name;
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
                        $sheet->row ($key + 8, $importedDatas);
                    }
                });
            })->download ('xls');
    }
    
    
    public function downloadDetailImport()
    {
        $details = $this->stuffFacService->getAllDetail();
        return Excel::create('Đại học bách khoa', function($excel) use ($details) {
                $excel->sheet('Kho', function($sheet) use ($details) {
                    $sheet->setHeight(4, 20);
                    $sheet->setAutoSize(false);
                    $sheet->cell('C4', function($cell) {
                        $cell->setFont(array(
                            'family' => 'Times New Roman',
                            'size' => '16',
                            'bold' => false
                        ));
                        $cell->setValue('DANH SÁCH TÀI SẢN TỒN KHO');
                    });
                    $sheet->setFontSize(10);
                    $sheet->cells('A6:K6', function($cells) {
                        $cells->setBackground('#00ffff');
                    });
                    $sheet->cells('A5:Z100', function($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->row(6, config('structure.list'));
                    foreach ($details as $key => $data) {
                        $importedDatas = array($key + 1, $data->id, $data->importStore->date_import,
                            $data->stuff->name, $data->stuff->supplier->name, $data->importStore->store->name, $data->quantity, number_format($data->quantity * $data->price_unit), $data->status);
                        $sheet->row($key + 7, $importedDatas);
                    }
                });
            })->download('xls');
    }
    
    public function downloadStuffInFaculty()
    {
        
    }
}
