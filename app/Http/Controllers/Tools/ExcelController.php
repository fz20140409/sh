<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class ExcelController extends Controller
{
    //
    static  function export($filename,$sheetname,$data){

        Excel::create($filename, function($excel) use($data,$sheetname) {

            $excel->sheet($sheetname, function($sheet) use($data) {

                $sheet->fromArray($data);

            });

        })->export('xls');

    }

    function import(){

    }
}
