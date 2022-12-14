<?php

namespace App\Http\Controllers\Auth;

use AlibabaCloud\SDK\Dingtalk\Voauth2_1_0\Dingtalk;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\SocialiteServiceProvider;
use Overtrue\Socialite\SocialiteManager;
// include "TopSdk.php";

class DingTalkController extends Controller
{
    public function reDirectDingTalk(){
      
        // DingTalkConstant::$METHOD_GET 要与下面调用接口url要求的保持一致
        // $c = new DingTalkClient(DingTalkConstant::$CALL_TYPE_OAPI, DingTalkConstant::$METHOD_GET , DingTalkConstant::$FORMAT_JSON);
        // $req = new OapiUserGetRequest();
        // $req->setUserid("userid1");
        // $resp=$c->execute($req, $accessToken,"https://oapi.dingtalk.com/user/get");
        // var_dump($resp); die;
        //$socialite = new SocialiteManager()
        $url = "https://oapi.dingtalk.com/connect/qrconnect?appid=dingzqdssz4xawqpd6li&response_type=code&scope=snsapi_login&state=STATE&redirect_uri='http:\'/\'/127.0.0.1:8000\'/auth\'/dingtalk\'/callback'";
        var_dump($url);die;
    }

    public function dingTalkCallback(Request $request){
   echo "c=dingcallback"; die;
    //     $dingUser =Socialite::create('dingtalk')->userFromCode($request->query('code'));
    //     //$dingUser = Socialite::driver('dingtalk')->user();
    //     echo "<pre>"; var_dump($dingUser); echo "</pre>"; die;
    //     $findUser = User::where('google_id', $dingUser->id)->first();
    //     if($findUser){
    //         Auth::login($findUser);
    //         return redirect('/home');
    //     }else {
    //         $newUser = User::create([
    //             'name' =>$dingUser->name,
    //             'email'=>$dingUser->email,
    //             'password'=>Hash::make('oppoGoogle'),
    //             'google_id'=>$dingUser->id
    //         ]);
    //     }
    }
}
