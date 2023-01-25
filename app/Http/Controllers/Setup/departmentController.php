<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;
class departmentController extends Controller
{
    public function __construct()
    {
        $this->getToken ="https://oapi.dingtalk.com/gettoken?";
        $this->departmentList = "https://oapi.dingtalk.com/topapi/v2/department/listsub?";
        $this->appKey = env('DINGTALK_APP_KEY');
        $this->appSecret = env('DINGTALK_APP_SECRET');
    }
    public function getAccessToken()
    {
        $url = $this->getToken.'appkey='.$this->appKey.'&appsecret='.$this->appSecret;
        $res = Http::get($url);
        return $res['access_token'];
    }

    public function index()
    {
        $res = DB::table('departmentList')->orderBy('created_at','desc')->paginate(20);
        return view('setup/department-index',['res'=>$res]);
    }
    public function fetchDepartmentApi(Request $request)
    {
        $parent_id = $request->input('parent_id'); 

        $url = $this->departmentList.'access_token='.$this->getAccessToken();
        $res = Http::post($url,[
            'language'=> 'zh_CN',
            'dept_id'=> $parent_id
        ]);
            $response = array();
            
        DB::table('departmentList')->where('parent_id', '=', $parent_id)->delete();

        foreach($res['result'] as $key=>$val){
            $response[$key] = [
                'dept_id'=>$val['dept_id'],
                'parent_id'=>$val['parent_id'],
                'dept_name'=>$val['name'],
                'created_at'=>now()
                ];        
        }

        DB::table('departmentList')->insert($response);
        return redirect()->route('department-list-index');
    }
}
