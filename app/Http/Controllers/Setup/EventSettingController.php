<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\EventSetting;
use Illuminate\Http\Request;

class EventSettingController extends Controller
{
    public function index(){
        $e_settings = EventSetting::all();
        return view('setup/present', ['e_settings'=>$e_settings]);
    }
}
