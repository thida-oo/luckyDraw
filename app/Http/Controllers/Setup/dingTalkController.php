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
        $this->getUserId = "https://oapi.dingtalk.com/topapi/v2/user/getbymobile?";
        $this->userDetail = "https://oapi.dingtalk.com/topapi/v2/user/get?";
        $this->appKey = env('DINGTALK_APP_KEY');
        $this->appSecret = env('DINGTALK_APP_SECRET');
    }
   
    public function getAccessToken()
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

    public function validateUserStatus($phone_number)
    {

        // get current login user id
        $access_token = $this->getAccessToken();
        // return $access_token;
        // $user_id_url = $this->getUserId.'access_token='.$access_token;
        // $res = Http::post($user_id_url,[
        //     "mobile"=>$phone_number
        // ]);
        // $current_login_id = $res['result']['userid'];

        // $user_detail_url = $this->userDetail.'access_token='.$access_token;
        // $response = Http::post($user_detail_url,[
        //     'language'=> 'zh_CN',
        //     'userid'=> $current_login_id
        // ]);
       
        // $user_status = $response['result']['active'];

        // return $user_status;

    }
}
