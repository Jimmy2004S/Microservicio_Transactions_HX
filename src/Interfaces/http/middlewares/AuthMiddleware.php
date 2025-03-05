<?php

namespace Src\Interfaces\http\middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $url = env('AUTH_MSERVICE_') . env('AUTH_MSERVICE_VALIDATE_TOKEN');

        // $response = Http::withHeaders([
        //     'Authorization' => $token
        // ])->get($url);

        // if (!$response->failed()) {
        //     return response()->json(['message' => 'Invalid token'], 401);
        // }

        $request->merge(['auth_user' => [
            'id' => 3,
        ]]);

        return $next($request);
    }
}
