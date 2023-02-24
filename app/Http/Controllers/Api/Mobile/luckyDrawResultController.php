<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class luckyDrawResultController extends Controller
{
 //   	public function __construct()
	// {
	//     $this->middleware('auth.mobile');
	// }
	public function index(Request $request)
{
    $records = DB::table('draw_imeis as di')
                ->select('di.*', 'u.name', 'p.present_name')
                ->join('presents as p', 'p.id', '=', 'di.present_id')
                ->join('users as u', 'u.id', '=', 'di.draw_by')
                ->paginate(3);
                
    $pages = $records->lastPage();
    
    return response()->json([
        'data' => $records->items(),
        'next_page_url' => $records->nextPageUrl(),
        'pages' => $pages
    ]);
}

}
