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
        $distributors = Distributor::all();
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
                return view('setup/distributor', ['distributors' => $distributors])->with('success', 'Data already imported');
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
