<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Present;
use Illuminate\Http\Request;
use DB;
class PresentController extends Controller
{
    public function index(){
        $presents = Present::paginate(10);
        return view('setup/present', ['presents'=>$presents]);
    }

    public function create(){
        return view('setup/present-create');
    }

    public function store(Request $request){
        //save data
        $present = new Present();

        $present->present_code = $present->createPresentCode();
        $present->present_name = $request->input('present_name');
        $present->present_no = $request->input('draw_no');
        $present->remark = $request->input('remark'); 

        if($request->hasFile('p_image')){
            $file = $request->file('p_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $present->present_code.'.'.$extension;
            $file->move('image/presentsImage/', $filename);
            $present->image = $filename;
        }
        $present->save();
        return redirect()->route('present-index');
    }
    public function edit($id)
    {
       $present = Present::find($id);
       return view('setup/present_edit',['present'=>$present]);
    }
    public function update(Request $request,$id)
    {
        $present = Present::find($id);
        if($request->hasFile('p_image')){
            $file = $request->file('p_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $present->present_code.'.'.$extension;
            $file->move('image/presentsImage/', $filename);
            $present->image = $filename;
        }
        $present->present_code = $request->input('present_code');
        $present->present_name = $request->input('present_name');
        // $present->draw_no      = $request->input('draw_no');
        $present->remark       = $request->input('remark');
        $present->save();
        return redirect()->route('present-index');
    }
    public function delete($id){
        $present = Present::find($id);
        $present->status = !$present->status;
        $present->save();
        return redirect()->route('present-index');
    }
    public function search(Request $request)
    {
        $searchTerm = '%' . $request->input('search') . '%';
        $presents = DB::table('presents')
            ->select('presents.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('present_name', 'like', $searchTerm)
                    ->orWhere('present_code', 'like', $searchTerm);
            });

            if($request->input('status')==1){
             $presents = $presents->where('status','1');  
            }elseif($request->input('status')==0){
             $presents = $presents->where('status','0');  
            }elseif($request->input('status')==2){
                $presents=$presents;
            }
          $presents = $presents->paginate(10);

           return view('setup/present', ['presents'=>$presents]);
    }
}
