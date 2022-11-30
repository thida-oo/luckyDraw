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

    public function import(Request $request){
        $import_file = $request->file;
        if($import_file){
            try{
                //var_dump($import_file); die;
                Excel::import(new DistributorImport, $import_file);
                return view('setup/distributor')->with('success', 'Data successfully imported');
            } catch(Exception $e){
               // var_dump($e);
               echo "Error Side";
            }            
        }
       
    }
}
