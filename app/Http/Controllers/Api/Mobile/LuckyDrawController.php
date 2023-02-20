<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LuckyDrawController extends Controller
{
	public function __construct()
{
    $this->middleware('auth.mobile');
}
	public function testtoken()
	{
	 return 'success';
	}

}
