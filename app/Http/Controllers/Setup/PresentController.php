<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Present;
use Illuminate\Http\Request;

class PresentController extends Controller
{
    public function index(){
        $presents = Present::all();
        return view('setup/present', ['presents'=>$presents]);
    }

    public function store(Request $request){
        //save data
        $present = New Present();
        $present->present_code = $request->input('present_code');
        $present->present_name = $request->input('present_name');
        $present->present_no = $request->input('draw_no');
        $present->remark = $request->input('remark'); 
        if($request->hasFile('p_image')){
            
        }
    }
}
