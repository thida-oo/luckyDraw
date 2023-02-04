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
        // distributor List
        // $distributor = DB::table("distributors")->select("distributor_code","distributor_name")->pluck("distributor_name", "distributor_code");

        // ASM Area List
        $area = DB::table("departmentList")->select("dept_name")->pluck("dept_name");
        
        // Product List
        $products = DB::table("products")->select("p_code","p_name")->pluck("p_code","p_name");

        // Stores
        $store = DB::table("store")->select("store_code")->pluck("store_code");

        $import_file = $request->file('file');
        if ($import_file) {
            try {
                Excel::import(new SaleImport($area,$products,$store), $import_file);
                return view('setup/import')->with('success', 'Data successfully imported');
            } catch (Exception $e) {

                Alert::info($e->getMessage())->persistent('Dismiss');
                 return redirect()->route('import');
            }
        }
        die;
    }
}
