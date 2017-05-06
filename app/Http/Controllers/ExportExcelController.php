<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportStuffService;
use App\Services\StuffFacultyService;

class ExportExcelController extends Controller
{

    private $excel;
    private $importStuffService;
    private $stuffFacService;

    public function __construct(
    Excel $excel, ImportStuffService $importStuffService, StuffFacultyService $stuffFacService)
    {
        $this->excel = $excel;
        $this->importStuffService = $importStuffService;
        $this->stuffFacService = $stuffFacService;
    }

    /**
     * Download excel for detail import store
     *
     * @var array
     */
    public function downloadDetailImportStoreById($id)
    {
        $importStore = $this->importStuffService->getImportStoreById($id);
        return Excel::create('KhoaCNTT', function($excel) use ($id, $importStore) {
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
    
    
}
