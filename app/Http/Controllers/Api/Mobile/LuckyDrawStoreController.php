<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\DrawIMEI;
class LuckyDrawStoreController extends Controller
{
    public function spinWheelData(Request $request)
{
        $imei_sn = $request->input('imei');
        $present_id = $request->input('present_id');
        $user_id = $request->input('user_id');

        $res = DB::table('stock as s')->join('store','s.store_code','=','store.store_code')->select('s.*','store.*')->where('s.imei_sn',$imei_sn)->get();
        // $res = DB::table('stock')->where('imei_sn',$imei_sn)->get();
        $present = DB::table('presents')->where('id',$present_id)->get();
        $val = DB::table('draw_imeis')->where('imei_sn',$imei_sn)->count();
        // store code - store name 
        if($val < 1){
            $draw_event = new DrawIMEI();
            $draw_event->imei_sn=$imei_sn;
            $draw_event->imei_sn_2=$res[0]->imei_sn_2;
            $draw_event->draw_store=$res[0]->store_code.' - '.$res[0]->store_name; 
            $draw_event->present_id =$present_id; 
            $draw_event->draw_by=$user_id;
            $draw_event->draw_date=now();
            $draw_event->save();
        }
        if($val > 0){
            return response()->json([
                'msg' => "This IMEI is already done by ".$present[0]->present_name.".",
                'status' => 200,
                'imei' => $imei_sn,
                'state' => false
            ]);
        }else{
            return response()->json(['msg'=>'Please take screenshoot after present is choose.','status'=>200,'imei'=>$imei_sn,'present'=>$present,'state'=>true]);
        }
}
}
