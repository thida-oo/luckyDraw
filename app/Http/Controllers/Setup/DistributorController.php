<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index(){
        return view('setup/distributor');
    }
}
