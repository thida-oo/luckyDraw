<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class LuckyDrawResultController extends Controller
{
    public function index()
    {
        $records = DB::table('draw_imeis as di')
                ->select('di.*', 'u.name', 'p.present_name')
                ->join('presents as p', 'p.id', '=', 'di.present_id')
                ->join('users as u', 'u.id', '=', 'di.draw_by')
                ->paginate(10);
        return view('report/draw_result',['records'=>$records]);
    }
    public function search(Request $request)
    {

        $searchTerm = '%' . $request->input('search') . '%';
        $startDate= $request->input('startDate');
        if($startDate == null){
            $startDate = date('Y-m-d',strtotime('1970-01-01'));
        }
        $endDate= $request->input('endDate');
        if($endDate == null){
            $endDate = date('Y-m-d',strtotime('2040-01-01'));
        }
        $search_records = DB::table('draw_imeis as di')
            ->select('di.*', 'u.name', 'p.present_name')
            ->join('presents as p', 'p.id', '=', 'di.present_id')
            ->join('users as u', 'u.id', '=', 'di.draw_by')
            ->where(function ($query) use ($searchTerm) {
                $query->where('p.present_name', 'like', $searchTerm)
                    ->orWhere('u.name', 'like', $searchTerm)
                    ->orWhere('di.imei_sn', 'like', $searchTerm)
                    ->orWhere('di.draw_store', 'like', $searchTerm);
            })
           ->whereBetween('di.draw_date', [$startDate, $endDate])
           ->paginate(10);

    return view('report/draw_result',['search_records'=>$search_records]);

    }

}

