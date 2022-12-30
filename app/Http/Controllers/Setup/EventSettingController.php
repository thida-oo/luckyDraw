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

class EventSettingController extends Controller
{
    public function index(){
        $e_settings = EventSetting::all();
        return view('setup/event-setting', ['e_settings'=>$e_settings]);
    }

    public function create(){  
        $present_lists = Present::all();
        $products = Product::all();
        return view('setup/event-setting-create', ['present_lists'=>$present_lists, 'products'=>$products]);
    }
     public function store(Request $request)
    {
        //dd($request->all());
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
        return redirect()->route('event-setting-create');
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
    
        return view('setup/event-setting',['res'=>$res,'products'=>$products,'productID'=>$productID,'present_lists'=>$present_lists]);
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
}
