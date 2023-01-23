<?php

namespace App\Http\Controllers\Draw;

use App\Http\Controllers\Controller;
use App\Models\DrawIMEI;
use App\Models\EventSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

use function PHPUnit\Framework\isEmpty;

class DrawController extends Controller
{
    public function index(){
        // need to date within event period, if not, don't show view
        $current_date = DATE('Y-m-d', strtotime(now()));
        $valid_event = EventSetting::whereDate('event_start_time','<=', $current_date)->whereDate('event_end_time','>=', $current_date)->where('status',1)->get();

        if(empty($valid_event)){
            return view('draw/invalid');
        } else {
            return view('draw/index');
           //return view('draw/spin');
        }
        
    }

    public function store(Request $request){
        
        // need to check IMEI is valid for draw
        // check valid IMEI is valid store and distributor

        $store_code = $request->input('store_id');
        $imei_sn = $request->input("imei_sn");

        $draw_imei = DB::table('draw_imeis')->where('imei_sn', 'like', $imei_sn)->get();

        if($draw_imei->isNotEmpty()){   
            Alert::warning('This IMEI already draw Once!( ဤ IMEI သည် ကံစမ်းပြီးသော IMEI ဖြစ်သည် )')->persistent('Dismiss');
            return view('draw/index'); // tell already done by draw
        } else { 
            //check valid product for current event
            
            $imei_data = DB::table('stock')
                            ->where('imei_sn', '=', $imei_sn)
                            ->where('store_code', '=', $store_code)
                            ->get();

            if($imei_data->isEmpty()){
                Alert::info('This IMEI does not exist in this store !( ဤ IMEI သည် ဆိုင်တွင် မရှိ သော IMEI ဖြစ်သည်  )')->persistent('Dismiss');
                return view('draw/index'); // IMEI doesn't exist in this store 
            } else {
                $current_date = DATE('Y-m-d', strtotime(now()));
                $valid_event = DB::table('event_settings')->whereDate('event_start_time','<=', $current_date)
                                ->whereDate('event_end_time','>=', $current_date)->where('status',1)
                                ->first();
                if($valid_event == null){
                    Alert::warning('ယနေ့အတွက် Event မရှိပါ။')->persistent('Dismiss');
                    return view('draw/index');
                }
                    $products = explode(',', $valid_event->product_id);

                if(!in_array($imei_data[0]->product_id, $products)){
                    Alert::warning('This IMEI Model is not allowed to participate! (ဤ IMEI ၏ Model သည် လက်ရှိ Event တွင် ပါ၀င်ခြင်း မရှိပါ )')->persistent('Dismiss');
                    return view('draw/index');  // This is not allowed product
                } else {
                    //allowed product
                    //draw here
                    $draw_presents = DB::table('event_setting_details')
                                ->select('event_setting_details.present_id', 'presents.present_name', 'event_setting_details.present_prob')
                                ->join('presents', 'event_setting_details.present_id', '=', 'presents.id')
                                ->where('event_setting_details.event_id', '=', $valid_event->id)
                                ->get()->toArray();

                              

                    if(empty($draw_presents)){
                        Alert::info('No Present set up, please contact Adminstrator!! (လက်ရှိ Event အတွက် လက်ဆောင် များ မရှိပါ, Admin သို့ ဆက်သွယ်ပါ !! )')->persistent('Dismiss');
                        return view('draw/index');
                    } else {
                        // dd($valid_event);

                        // dd($draw_presents);
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
                            
                             return view('draw/spin', [
                            'id_lists' => array_column($draw_presents, 'present_id'),
                            'draw_presents' => $draw_presents,
                            'prob_lists' => array_column($draw_presents, 'present_prob'),
                            'present_draw' => $present_draw,
                            'imei_sn' => $imei_sn,
                            'valid_event' => $valid_event,
                            ]);

                    }
                   
                }

            }
            
        }      
    }

    public function present(Request $request)
    {

        $imei_sn = $request->input('imei');
        $present_id = $request->input('present_id');

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
            $draw_event->draw_by=Auth::user()->id;
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
