<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class LuckyDrawController extends Controller
{
	public function __construct()
{
    $this->middleware('auth.mobile');
}
	public function index(Request $request)
	{
		DB::table('draw_imeis')->where('draw_by','=',$request->input('user_id'))->get();
	}
    public function spinDraw(Request $request){

        $store_code = $request->input('store_id');
        $imei_sn = $request->input("imei_sn");
        $user_id = $request->input("user_id");

        $draw_imei = DB::table('draw_imeis')->where('imei_sn', 'like', $imei_sn)->get();

        if($draw_imei->isNotEmpty()){   
        	return response()->json(['msg'=>'This IMEI already draw Once!( ဤ IMEI သည် ကံစမ်းပြီးသော IMEI ဖြစ်သည်','status'=>'error']);
        
        } else { 
            //check valid product for current event
            
            $imei_data = DB::table('stock')
                            ->where('imei_sn', '=', $imei_sn)
                            ->where('store_code', '=', $store_code)
                            ->get();

            if($imei_data->isEmpty()){
            	return response()->json(['msg'=>'This IMEI does not exist in this store !( ဤ IMEI သည် ဆိုင်တွင် မရှိ သော IMEI ဖြစ်သည်','status'=>'error']);
              
            } else {
                $current_date = DATE('Y-m-d', strtotime(now()));
                $valid_event = DB::table('event_settings')->whereDate('event_start_time','<=', $current_date)
                                ->whereDate('event_end_time','>=', $current_date)->where('status',1)
                                ->first();
                if($valid_event == null){
                	return response()->json(['msg'=>'ယနေ့အတွက် Event မရှိပါ။','status'=>'error']);
                }
                    $products = explode(',', $valid_event->product_id);

                if(!in_array($imei_data[0]->product_id, $products)){
                	return response()->json(['msg'=>'This IMEI Model is not allowed to participate! (ဤ IMEI ၏ Model သည် လက်ရှိ Event တွင် ပါ၀င်ခြင်း မရှိပါ','status'=>'error']);
                } else {
                    $draw_presents = DB::table('event_setting_details')
                                ->select('event_setting_details.present_id', 'presents.present_name', 'event_setting_details.present_prob')
                                ->join('presents', 'event_setting_details.present_id', '=', 'presents.id')
                                ->where('event_setting_details.event_id', '=', $valid_event->id)
                                ->get()->toArray();

                              

                    if(empty($draw_presents)){
                    	return response()->json(['msg'=>'No Present set up, please contact Adminstrator!! (လက်ရှိ Event အတွက် လက်ဆောင် များ မရှိပါ, Admin သို့ ဆက်သွယ်ပါ !!','status'=>'error']);
                    } else {
                        $present_draw=array();
                        foreach($draw_presents as $key=>$value){
                            if($value->present_prob <= 5){

                            }
                            if(($value->present_prob >=6 && $value->present_prob <= 10) || ($value->present_prob >=11 && $value->present_prob <= 15)){
                                $present_draw[] = $value;
                            }
                            if(($value->present_prob >=16 && $value->present_prob <= 20) || ($value->present_prob >=21 && $value->present_prob <= 25) ){
                                for($i=1;$i<=2; $i++){
                                    $present_draw[] = $value;
                                }
                            }
                            if(($value->present_prob >=26 && $value->present_prob <= 30) || ($value->present_prob >=31 && $value->present_prob <= 35) ){
                                for($i=1;$i<=3; $i++){
                                    $present_draw[] = $value;
                                }
                            }
                            if(($value->present_prob >=36 && $value->present_prob <= 40) || ($value->present_prob >=41 && $value->present_prob <= 45) ){
                                for($i=1;$i<=4; $i++){
                                    $present_draw[] = $value;
                                }
                            }
                            if(($value->present_prob >=46 && $value->present_prob <= 50) || ($value->present_prob >=51 && $value->present_prob <= 55) ){
                                for($i=1;$i<=5; $i++){
                                    $present_draw[] = $value;
                                }
                            }
                            if(($value->present_prob >=56 && $value->present_prob <= 60) || ($value->present_prob >=61 && $value->present_prob <= 65) ){
                                for($i=1;$i<=6; $i++){
                                    $present_draw[] = $value;
                                }
                            }
                            if(($value->present_prob >=66 && $value->present_prob <= 70) || ($value->present_prob >=71 && $value->present_prob <= 75) ){
                                for($i=1;$i<= 7; $i++){
                                    $present_draw[] = $value;
                                }
                            }
                            if(($value->present_prob >=76 && $value->present_prob <= 80) || ($value->present_prob >=81 && $value->present_prob <= 85) ){
                                for($i=1;$i<=8; $i++){
                                    $present_draw[] = $value;
                                }
                            }
                           if(($value->present_prob >=86 && $value->present_prob <= 90) || ($value->present_prob >=91 && $value->present_prob <= 95) ){
                                for($i=1;$i<=9; $i++){
                                    $present_draw[] = $value;
                                }
                            }

                        }
                        
                            shuffle($present_draw);
                            
                            return response()->json([
                            'id_lists' => array_column($draw_presents, 'present_id'),
                            'draw_presents' => $draw_presents,
                            'prob_lists' => array_column($draw_presents, 'present_prob'),
                            'present_draw' => $present_draw,
                            'imei_sn' => $imei_sn,
                            'user_id' => $user_id,
                            'valid_event' => $valid_event,
                            'status'=>'success']);

                    }
                   
                }

            }
            
        }      
    }
}
