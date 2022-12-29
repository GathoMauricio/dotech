<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class DataMigrater extends Controller
{
    /**
     * \brief Método ExcelArray de la clase DataMigrater.
     * \param string $excel
     * \param string $url (opcional)
     * \param string $sheet (opcional)
     * \param int $start (opcional)
     * \return array $array
     * \see PhpOffice\PhpSpreadsheet\Reader\Xlsx
     * \note Extrae información de un archivo .xlsx y lo transforma en un arreglo.
     */
	public static function ExcelArray($excel, $url=null, $sheet=null, $start=null){
		$reader = new Xlsx();
		if(is_null($url)){
			$spreadsheet = $reader->load(storage_path('initial/'.$excel));
		}else
		{
			$spreadsheet = $reader->load(storage_path($url.'/'.$excel));
		}

		if(is_null($sheet)){
			$worksheet = $spreadsheet->getActiveSheet();
		}else{
			$worksheet = $spreadsheet->getSheet($sheet);
		}
		$array  = [];
		$header = [];
		$head   = true;

		foreach ($worksheet->getRowIterator() as $row) {
		    $cellIterator = $row->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(FALSE);

		    $line = [];
		    if(is_null($start)){
		    	$i = 0;
		    }else{
		    	$i = $start;
		    }

		    foreach ($cellIterator as $cell) {
		    	$val = $cell->getValue();
		    	if($head){
		    		$header[] = $val;
		    	}else{

		    		$line[$header[$i]] = ($val === 'NULL')?null:$val;
		    	}
		    	$i++;
		    }

		    if($head){
		    	$head    = false;
		    }else{
		    	$line['created_at'] = date('Y-m-d H:i:s');
		    	$line['updated_at'] = date('Y-m-d H:i:s');
		    	//$line['active'] = true;
		    	$array[] = $line;
		    }

		}

		return $array;
	}

	/**
     * \brief Método DataToExcel de la clase DataMigrater.
     * \param Collection $query
     * \param string $name
     * \return string
     * \see PhpOffice\PhpSpreadsheet\Spreadsheet
     * \see PhpOffice\PhpSpreadsheet\Writer\Xls
     * \note Transforma una consulta de la base de datos a un archivo de .xlsx y entrega la ubicación del archivo.
     */
	public static function DataToExcel($query,$name){
		$header = [collect($query->first())->keys()];
        $all = collect($header)->merge($query->toArray());
		$query = $all->toArray();
		$spreadsheet = new Spreadsheet();
		$Excel_writer = new Xlsx($spreadsheet);
		$spreadsheet->setActiveSheetIndex(0);
		$activeSheet = $spreadsheet->getActiveSheet()->fromArray($query,null,'A1');
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
		$writer->save(storage_path("xlsx/structures.xlsx"));
		return 'xlsx/'.$name;

	}

}
