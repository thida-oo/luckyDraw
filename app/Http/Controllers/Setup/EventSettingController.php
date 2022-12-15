<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\EventSetting;
use App\Models\Present;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EventSettingController extends Controller
{
    public function index(){
        $e_settings = EventSetting::all();
        return view('setup/event-setting', ['e_settings'=>$e_settings]);
    }

    public function create(){ 
        $present_lists = Present::all();
        $products = Product::all();
        return view('setup/event-setting', ['present_lists'=>$present_lists, 'products'=>$products]);
    }
     public function store(Request $request)
    {
        // dd($request->all());
        $products = $request->input('product');
        $presents = $request->input('present_id');
        $products = implode(',', $products);
        $presents = implode(',', $presents);

        $eventSetting = new EventSetting();
        $eventSetting->name=$request->input('name');
        $eventSetting->event_start_time=$request->input('start_time');
        $eventSetting->event_end_time=$request->input('end_time');
        $eventSetting->product_id=$products;
        $eventSetting->present_id=$presents;
        $eventSetting->created_by=Auth::user()->id;
        $eventSetting->save();
        return redirect()->route('event-setting-create');
    }
}
