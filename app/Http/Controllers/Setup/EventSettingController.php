<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\EventSetting;
use App\Models\EventSettingDetail;
use App\Models\Present;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EventSettingController extends Controller
{
    public function index(){
        $e_settings = EventSetting::orderBy('created_at','desc')->where('status',1)->paginate(10);
        return view('setup/event-setting', ['e_settings'=>$e_settings]);
    }

    public function create(){  
        $present_lists = Present::all();
        $products = Product::all();
        return view('setup/event-setting-create', ['present_lists'=>$present_lists, 'products'=>$products]);
    }
     public function store(Request $request)
    {
        if(array_sum($request->input('draw_probability'))!=100){
            Alert::warning("The sum of percentage is must be 100%;")->persistent('Dismiss');
                 return redirect()->route('event-setting-create');
        }
        $event_start = $request->input('start_time');
        $event_end = $request->input('end_time');
        $products = $request->input('product');
        $presents = $request->input('present_id');
        $draw_probability = $request->input('draw_probability');

        $products = implode(',', $products);

        // echo "<pre><br>"; var_dump($presents); echo "</pre><br>";
        // dd($draw_probability);

        //Vaildation for event time
        $valid_time = EventSetting::whereBetween('event_start_time',[DATE('Y-m-d', strtotime($event_start)), DATE('Y-m-d', strtotime($event_end))])
                   ->orwhereBetween('event_end_time', [DATE('Y-m-d', strtotime($event_start)), DATE('Y-m-d', strtotime($event_end))])->count();

        if($valid_time == 0){ 
            $eventSetting = new EventSetting();
            $eventSetting->name                 = $request->input('name');
            $eventSetting->event_start_time     = $request->input('start_time');
            $eventSetting->event_end_time       = $request->input('end_time');
            $eventSetting->product_id           = $products;
            //$eventSetting->present_id           =$presents;
            $eventSetting->created_by           = Auth::user()->id;
            $saved = $eventSetting->save();

            if ($saved) {
                $event = DB::table('event_settings')
                    ->whereDate('event_start_time', '=', date('Y-m-d', strtotime($event_start)))
                    ->whereDate('event_end_time', '=', date('Y-m-d', strtotime($event_end)))
                    ->get();


                foreach ($presents as $k => $value) {
                
                    $eventDetails = new EventSettingDetail();

                    $eventDetails->event_id     = $event[0]->id;
                    $eventDetails->present_id   = $value;
                    $eventDetails->present_prob = $draw_probability[$value -1];
                    $eventDetails->created_by   = Auth::user()->id;
                    $eventDetails->save();
                }
            } else {
                // if save is not successful
            }
            Alert::success('Successful','Event is already saved!')->persistent('Dismiss');
            return redirect()->route('event-setting-index');
        } else {
            Alert::warning('Event Time is duplicate (????????????????????? ?????????????????????????????? ??????????????? Event ????????????????????????????????????????????? ??????????????????????????? ??????????????????????????????')->persistent('Dismiss');
            return redirect()->route('event-setting-index');
        }
    }

    public function overview($id)
    {
        $present_lists = Present::all();
        $products = Product::all();
        $res = DB::table('event_settings as es')
        ->join('event_setting_details as esd','es.id','=','esd.event_id')
        ->join('presents as pre','pre.id','=','esd.present_id')
        ->join('products as pro','pro.id','=','es.product_id')
        ->select('es.*','esd.*','pre.id as present_id','pre.present_name','pre.present_code','pro.id as product_id','pro.p_name as product_name','pre.image')->where('es.id',$id)->get();
        $event_product = DB::table('event_settings')->where('id',$id)->get();
        $productID = $event_product[0]->product_id;
        $productID = explode(",",$productID);
    
        return view('setup/event-setting-overview',['res'=>$res,'products'=>$products,'productID'=>$productID,'present_lists'=>$present_lists]);
    }
    public function edit($id)
    {
        $present_lists = Present::all();
        $products = Product::all();
        $res = DB::table('event_settings as es')
        ->join('event_setting_details as esd','es.id','=','esd.event_id')
        ->join('presents as pre','pre.id','=','esd.present_id')
        ->join('products as pro','pro.id','=','es.product_id')
        ->select('es.*','esd.*','pre.id as present_id','pre.present_name','pre.present_code','pro.id as product_id','pro.p_name as product_name','pre.image')->where('es.id',$id)->get();
        $event_product = DB::table('event_settings')->where('id',$id)->get();
        $productID = $event_product[0]->product_id;
        $productID = explode(",",$productID);
    
        return view('setup/event-setting-edit',['res'=>$res,'products'=>$products,'productID'=>$productID,'present_lists'=>$present_lists]);
    }
    public function update(Request $request)
    {
        // dd($request->all());
        DB::table("event_setting_details")->where('event_id',$request->input('event_id'))->delete();
        DB::table("event_settings")->where('id',$request->input('event_id'))->delete();

        $event_start = $request->input('start_time');
        $event_end = $request->input('end_time');
        $products = $request->input('product');
        $presents = $request->input('present_id');
        $draw_probability = $request->input('draw_probability');

        $products = implode(',', $products);


        $eventSetting = new EventSetting();
        $eventSetting->name                 = $request->input('name');
        $eventSetting->event_start_time     = $request->input('start_time');
        $eventSetting->event_end_time       = $request->input('end_time');
        $eventSetting->product_id           = $products;
        //$eventSetting->present_id           =$presents;
        $eventSetting->created_by           = Auth::user()->id;
        $saved = $eventSetting->save();
        if ($saved) {
            $event = DB::table('event_settings')
                ->whereDate('event_start_time', '=', date('Y-m-d', strtotime($event_start)))
                ->whereDate('event_end_time', '=', date('Y-m-d', strtotime($event_end)))
                ->get();

                // dd($event);

            foreach ($presents as $k => $value) {
                $eventDetails = new EventSettingDetail();

                $eventDetails->event_id     = $event[0]->id;
                $eventDetails->present_id   = $value;
                $eventDetails->present_prob = $draw_probability[$k];
                $eventDetails->created_by   = Auth::user()->id;
                $eventDetails->save();
            }
        } else {
            // if save is not successful
        }
        return redirect()->route('event-setting');
    }
    public function search(Request $request)
    {
        $searchTerm = '%' . $request->input('search') . '%';

        $e_settings = DB::table('event_settings')->where('name','like',$searchTerm)->paginate(10);
        return view('setup/event-setting', ['e_settings'=>$e_settings]);
    }
    public function delete($id)
    {
         DB::table('event_setting_details')
    ->updateOrInsert(['id' => $id], ['status' => 0]);
            return redirect()->route('event-setting-index');
         
    }
}
