<?php

namespace App\Http\Controllers\Draw;

use App\Http\Controllers\Controller;
use App\Models\DrawIMEI;
use App\Models\EventSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class DrawController extends Controller
{
    public function index(){
        // need to date within event period, if not, don't show view
        $current_date = DATE('Y-m-d', strtotime(now()));
        $valid_event = EventSetting::whereDate('event_start_time','<=', $current_date)->whereDate('event_end_time','>=', $current_date)->count();
        
        if(empty($valid_event)){
            return view('draw/invalid');
        } else {
            return view('draw/index');
        }
        
    }

    public function store(Request $request){
        
        // need to check IMEI is valid for draw
        // check valid IMEI is valid store and distributor

        $store_code = $request->input('store_id');
        $imei_sn = $request->input("imei_sn");

        $draw_imei = DB::table('draw_imei')->where('imei_sn', 'like', $imei_sn)->get();

        if($draw_imei->isNotEmpty()){   
            return view('draw/index'); // tell already done by draw
        } else { 
            //check valid product for current event
            
            $imei_data = DB::table('stock')
                            ->where('imei_sn', '=', $imei_sn)
                            ->where('store_code', '=', $store_code)
                            ->get();

            if($imei_data->isEmpty()){
                return view('draw/index'); // IMEI doesn't exist in this store 
            } else {
                $current_date = DATE('Y-m-d', strtotime(now()));
                $valid_event = DB::table('event_settings')->whereDate('event_start_time','<=', $current_date)
                                ->whereDate('event_end_time','>=', $current_date)
                                ->first();
                
                $products = explode(',', $valid_event->product_id);

                if(!in_array($imei_data[0]->product_id, $products)){
                    return view('draw/index');  // This is not allowed product
                } else {

                    //allowed product
                    //draw here
                    $draw_presents = DB::table('event_setting_details')
                                ->select('id', 'present_id', 'present_prob')
                                ->where('event_id', '=', $valid_event->id)
                                ->get()->toArray();
                                //dd(array_column($draw_presents, 'id'));
                    //$id_lists = array_column($id_lists, 'id' );

                return view('draw/spin', ['id_lists'=> array_column($draw_presents, 'id'), 
                                        'present_lists'=>array_column($draw_presents, 'present_id'), 
                                        'prob_lists'=>array_column($draw_presents, 'present_prob')]);
                //return view('draw/spin', ['id_lists'=> $draw_presents]);
                           // dd($draw_presents);
                   
                }

            }
            
        }      

    }

    
}
