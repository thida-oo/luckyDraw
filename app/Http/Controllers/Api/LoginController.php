<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Firebase\JWT\JWT;
class LoginController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['loginWithCode','getProfileData']]);
    }

   public function loginWithCode(Request $request)
{
    $userLoginCode = $request->input('loginCode');

    if($userLoginCode==null ){
        return response()->json(['status'=>'error','msg'=>'Login Code cannot be blank.']);
    }

    $user = User::where('loginCode','=', $userLoginCode)->first();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'msg' => 'Unauthorized',
        ]);
    }
    $expiresIn = time() + (60 * 60);

    $token = Str::random(60);
   
    $user->api_token = $token;
    $user->api_token_expire = date('Y-m-d H:i:s', $expiresIn);
    $user->save();
    return response()->json([
        'status' => 'success',
        'user' => $user,
        'authorisation' => [
            'token' => $token,
            'type' => 'bearer',
        ]
    ]);
}

   public function getProfileData(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ]);
    }

    $user = User::where('api_token', $token)->first();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
        ]);
    }

    return response()->json([
        'status' => 'success',
        'user' => $user,
    ]);
}

public function test()
{
return 'success';
}
    
 
}
