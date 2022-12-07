<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\EventSetting;
use App\Models\Present;
use App\Models\Product;
use Illuminate\Http\Request;

class EventSettingController extends Controller
{
    public function index(){
        $e_settings = EventSetting::all();
        return view('setup/event-setting', ['e_settings'=>$e_settings]);
    }

    public function create(){
        $present_lists = Present::all();
        $products = Product::all();
        return view('setup/event-setting', ['$present_lists'=>$present_lists, '$products'=>$products]);
    }
}
