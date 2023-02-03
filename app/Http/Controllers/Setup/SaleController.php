<?php

namespace App\Http\Controllers\Setup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\SaleImport;
use App\Models\Sale;
use DB;
use Maatwebsite\Excel\Facades\Excel;
class SaleController extends Controller
{
    public function _saleImport(Request $request)
    {   
        $res = DB::table("distributors")->select("distributor_code","distributor_name")->pluck("distributor_name", "distributor_code");

        $import_file = $request->file('file');
        if ($import_file) {
            try {
                Excel::import(new SaleImport($res), $import_file);
                return view('setup/import')->with('success', 'Data successfully imported');
            } catch (Exception $e) {

                dd($e);
            }
        }
        die;
    }
}
