<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Socialite\dingTalkProvider;
use Illuminate\Support\Facades\Http;

class dingTalkController extends Controller
{
    protected $getToken;
    protected $getDepartment;
    protected $getSubDepartment;
    protected $appKey; 
    protected $appSecret;

    public function __construct()
    {
        $this->getToken ="https://oapi.dingtalk.com/gettoken?";
        $this->getDepartment = "https://oapi.dingtalk.com/topapi/v2/department/listsub?";
        $this->getSubDepartment = "https://oapi.dingtalk.com/topapi/v2/department/listsub?";
        $this->appKey = env('DINGTALK_APP_KEY');
        $this->appSecret = env('DINGTALK_APP_SECRET');
    }
   
    private function getAccessToken()
    {
        $url = $this->getToken.'appkey='.$this->appKey.'&appsecret='.$this->appSecret;
        $res = Http::get($url);
        return $res['access_token'];
    }

    private function getDepartmentList($dept_id)
    {
        $url = $this->getDepartment.'access_token='.$this->getAccessToken();
        if($dept_id == null){
             $res = Http::post($url,[
            'language'=> 'zh_CN',
            'dept_id'=> 1
        ]);
        }else{
             $res = Http::post($url,[
            'language'=> 'zh_CN',
            'dept_id'=> $dept_id
        ]);
        }

        return $res['result'];
    }
    public function orderAndListDepartment($value='')
    {
     foreach ($this->getDepartmentList(null) as $key => $value) {
         

     }
     die;
    }
    public function test()
    {
        return "text";
    }
}
