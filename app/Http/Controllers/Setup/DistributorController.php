<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Imports\DistributorImport;
use App\Models\Distributor;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Psy\Readline\Hoa\Console;

class DistributorController extends Controller
{
    public function index(){
        $distributors = Distributor::paginate(10);
        return view('setup/distributor', ['distributors' => $distributors]);
    }

    public function distributorImport(){
        return view('setup/distributor-import');
    }

    public function _distributorImport(Request $request){

        Distributor::where('type',3)->delete();

        $import_file = $request->file('distributor_file');
        if($import_file){
            try{
                Excel::import(new DistributorImport, $import_file);
                $distributors = Distributor::all();                
            } catch(Exception $e){

               dd($e);
            }            
            return redirect()->route('distributor-index')->with('success', 'Data already imported');
        }
       
    }
    public function import()
    {
        return view('setup/import');
    }
    public function distributorSearch(Request $request)
    {
        $distributor = new Distributor();
        $distributors=$distributor->_searchDistributor($request->input('distributor_search'));
        return view('setup/distributor', ['distributors' => $distributors]);
    }
}
