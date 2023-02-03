<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\KpiSettings;
use App\Models\Product;
use Illuminate\Http\Request;

class KpiSettingController extends Controller
{
    public function index(){
        $kpi_lists = KpiSettings::orderBy('created_at','desc');
        $kpi_lists = $kpi_lists->paginate(10);
        return view('setup/kpi-setting-index', ['kpi_lists'=> $kpi_lists]);
    }

    public function create(){
        $sku_lists = Product::all();
        return view('setup/kpi-setting-create', ['sku_lists'=> $sku_lists]);
    }
    
    public function store(Request $request){
        $kpi_setting = new KpiSettings();

        $kpi_setting->sku_id = $request->input('sku_name');
        $kpi_setting->staff_type = $request->input('staff_type');
        $kpi_setting->amount = $request->input('kpi_amt');
        $kpi_setting->started_date = $request->input('started_date');
        $kpi_setting->ended_date = null;
        $kpi_setting->save();


        $kpi_lists = KpiSettings::orderBy('created_at','desc');
        $kpi_lists = $kpi_lists->paginate(10);

        return view('setup/kpi-setting-index', ['kpi_lists'=> $kpi_lists]);

    }

}
