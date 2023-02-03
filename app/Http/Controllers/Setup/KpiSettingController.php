<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\KpiSettings;
use App\Models\Product;


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
    
    public function store(){

    }

}
