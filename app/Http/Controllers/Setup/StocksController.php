<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stocks;
use App\Imports\StockImport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
ini_set('max_execution_time', 300); // 300 seconds = 5 minutes
ini_set('upload_max_filesize', '10M');
class StocksController extends Controller
{
    public function _stockImport(Request $request)
    {
        $import_file = $request->file('file');
        if ($import_file) {
            try {
                Excel::import(new StockImport, $import_file);
                return view('setup/import')->with('success', 'Data successfully imported');
            } catch (Exception $e) {

                dd($e);
            }
        }
    }
}
