<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Models\Item;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;

class MaatwebsiteDemoController extends Controller
{
    private $excel;
    
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    /**
     * Return View file
     *
     * @var array
     */
	public function importExport()
	{
		return view('importExport');
	}

	/**
     * File Export Code
     *
     * @var array
     */
	public function downloadExcel(Request $request, $type)
	{
		$data = User::all();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

	/**
     * Import file into database Code
     *
     * @var array
     */
	public function importExcel(Request $request)
	{
		if($request->hasFile('import_file')){
			$path = $request->file('import_file')->getRealPath();

            $data = Excel::load(Input::file('import_file'), function($reader) {
                $reader->each(function($sheet) {
                    dd($sheet->toArray());
                });
                //something else
                
            })->get();

			if(!empty($data) && $data->count()){

				foreach ($data->toArray() as $key => $value) {
					if(!empty($value)){
						foreach ($value as $v) {		
							$insert[] = ['title' => $v['title'], 'description' => $v['description']];
						}
					}
				}

				
				if(!empty($insert)){
					Item::insert($insert);
					return back()->with('success','Insert Record successfully.');
				}

			}

		}

		return back()->with('error','Please Check your file, Something is wrong there.');
	}

}
