<?php

namespace Src\Interfaces\http\middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Src\Infrastructure\Api\AuthService;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $response = AuthService::getUserFromToken($token);

        if (!$response->failed()) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $request->merge(['auth_user' => $response->user]);

        return $next($request);
    }
}
