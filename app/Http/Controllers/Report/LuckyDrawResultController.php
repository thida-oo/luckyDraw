<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LuckyDrawResultController extends Controller
{
    public function index(){
        return view('report/report-lucky-draw-result');
    }
}
