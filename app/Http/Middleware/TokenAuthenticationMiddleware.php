<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class TokenAuthenticationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();
        if ($bearerToken) {
            $user = User::where('api_token', $bearerToken)->first();
            if ($user && $user->api_token_expire > now()) {
                $request->merge(['user' => $user]);
                return $next($request);
            }
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
