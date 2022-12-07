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
        $stores = Store::paginate(10);
        return view('setup/store', ['stores' => $stores]);
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
    public function storeSearch(Request $request)
    {
        $store = new Store();
        $stores=$store->_searchStores($request->input('store_search'));
        return view('setup/store', ['stores' => $stores]);
    }
}
