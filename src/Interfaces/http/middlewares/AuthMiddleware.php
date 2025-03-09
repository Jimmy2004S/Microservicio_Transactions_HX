<?php

namespace Src\Interfaces\http\middlewares;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Src\Infraestructure\Api\AuthService as ApiAuthService;
use Src\Infraestructure\Api\LogService;
use Src\Infrastructure\Api\AuthService;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        try {

            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['message' => 'Token not provided'], 401);
            }

            $response = ApiAuthService::getUserFromToken($token);

            // Extraer el usuario del JSON correctamente
            $data = $response->json();


            if (!$data['success']) {
                return response()->json(['message' => 'Problem in the external api'], 500);
            }

            $user = $data['user'];

            // Agregar el usuario autenticado al request
            $request->merge(['user' =>  $user]);
            return $next($request);
        } catch (Exception $e) {
            LogService::store('transaction', 'get', $e->getMessage());
            return response()->json(
                ['error' => 'Error authenticating user'],
                401
            );
        }
    }
}
