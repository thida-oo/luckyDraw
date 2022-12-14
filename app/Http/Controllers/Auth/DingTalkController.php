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
use Laravel\Socialite\Two\InvalidStateException;
use Overtrue\Socialite\SocialiteManager;
// include "TopSdk.php";

class DingTalkController extends Controller
{
    public function reDirectDingTalk(){
    
		return Socialite::driver('dingtalk')->redirect();
    }

    public function dingTalkCallback(Request $request){

        $dingUser = Socialite::driver('dingtalk')->user();

        //dd($dingUser);

        $findUser = User::where('google_id', $dingUser->id)->first();

        if($findUser){ 
            Auth::login($findUser);
            return redirect('/home');
        }else {

            $newUser = User::create([
                'name' =>$dingUser->name,
                'email'=>is_null( $dingUser->email)? $dingUser->unionid : $dingUser->email,
                'password'=>Hash::make('oppoGoogle'),
                'google_id'=>$dingUser->id,
                'avatar'=>$dingUser->avatar,
            ]);
			
			Auth::login($newUser);
            return redirect()->back();
        }
    }
}
