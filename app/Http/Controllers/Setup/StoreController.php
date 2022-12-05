<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Imports\StoreImport;
use App\Models\Store;
use App\Models\Distributor;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Readline\Hoa\Console;

class StoreController extends Controller
{
    public function index(){
        $store = Store::all();
        return view('setup/store', ['store' => $store]);
    }

    public function storeImport(){
        return view('setup/store-import');
    }
    public function _storeImport(Request $request){

        $import_file = $request->file('file');

        if($import_file){
            try{
                Excel::import(new StoreImport, $import_file);
                return view('setup/import')->with('success', 'Data successfully imported');
            } catch(Exception $e){

               dd($e);
            }            
        }
       
    }
    public function import()
    {
        return view('setup/import');
    }
}
