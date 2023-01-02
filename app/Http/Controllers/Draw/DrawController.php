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
        $valid_event = EventSetting::whereDate('event_start_time','<=', $current_date)->whereDate('event_end_time','>=', $current_date)->count();
        
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
            Alert::warning('This IMEI already draw Once!( ဤ IMEI သည် ကံစမ်းပြီးသော IMEI ဖြစ်သည် )');
            return view('draw/index'); // tell already done by draw
        } else { 
            //check valid product for current event
            
            $imei_data = DB::table('stock')
                            ->where('imei_sn', '=', $imei_sn)
                            ->where('store_code', '=', $store_code)
                            ->get();

            if($imei_data->isEmpty()){
                Alert::info('This IMEI does not exist in this store !( ဤ IMEI သည် ဆိုင်တွင် မရှိ သော IMEI ဖြစ်သည်  )');
                return view('draw/index'); // IMEI doesn't exist in this store 
            } else {
                $current_date = DATE('Y-m-d', strtotime(now()));
                $valid_event = DB::table('event_settings')->whereDate('event_start_time','<=', $current_date)
                                ->whereDate('event_end_time','>=', $current_date)
                                ->first();
                
                $products = explode(',', $valid_event->product_id);

                if(!in_array($imei_data[0]->product_id, $products)){
                    Alert::warning('This IMEI Model is not allowed to participate! (ဤ IMEI ၏ Model သည် လက်ရှိ Event တွင် ပါ၀င်ခြင်း မရှိပါ )');
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
                        Alert::info('No Present set up, please contact Adminstrator!! (လက်ရှိ Event အတွက် လက်ဆောင် များ မရှိပါ, Admin သို့ ဆက်သွယ်ပါ !! )');
                        return view('draw/index');
                    } else {

                        // $draw_event = new DrawIMEI();
                        // $draw_event->imei_sn=$imei_sn;
                        // $draw_event->draw_store=$store_code; 
                        // $draw_event->draw_by=Auth::user()->id;
                        // $draw_event->draw_date=now();
                        // $draw_event->save();

                    return view('draw/spin', [
                            'id_lists' => array_column($draw_presents, 'present_id'),
                            'draw_presents' => $draw_presents,
                            'prob_lists' => array_column($draw_presents, 'present_prob'),
                            'imei_sn' => $imei_sn
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

        $res = DB::table('stock')->where('imei_sn',$imei_sn)->get();

            $draw_event = new DrawIMEI();
            $draw_event->imei_sn=$imei_sn;
            $draw_event->imei_sn_2=$res[0]->imei_sn_2;
            $draw_event->draw_store=$res[0]->store_code; 
            $draw_event->present_id=$present_id; 
            $draw_event->draw_by=Auth::user()->id;
            $draw_event->draw_date=now();
            $draw_event->save();

        return response()->json(['msg'=>'success','status'=>200,'imei'=>$imei_sn,'present_id'=>Auth::user()->id]);
    }

    
}
