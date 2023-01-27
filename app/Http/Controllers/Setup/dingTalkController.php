<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Socialite\dingTalkProvider;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
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

    public function validateUserStatus($contact_number)
    {

        // get current login user id
        $access_token = $this->getAccessToken();
        $user_id_url = $this->getUserId.'access_token='.$access_token;
        $res = Http::post($user_id_url,[
            "mobile"=>$contact_number
        ]);
        if(isset($res['result'])){

           $current_login_id = $res['result']['userid'];

        $user_detail_url = $this->userDetail.'access_token='.$access_token;
        $response = Http::post($user_detail_url,[
            'language'=> 'zh_CN',
            'userid'=> $current_login_id
        ]);
       $user = User::where('contact_number', $contact_number)->first();
       if(isset($response['result']['title'])){
          $user->title = $response['result']['title'];
       }else{
         $user->title = null;
       }
        $user->status = 1;

        $user->dept_id = $response['result']['dept_id_list'];
        $user->save();


            return view('home');
        }else{
            Auth::logout();
            Session::flush();
             return Redirect::to('/')->withErrors(['error_code' => '401', 'error_message' => 'User have Unauthorized']);
        }
        
        // return $user_status;

    }
}
