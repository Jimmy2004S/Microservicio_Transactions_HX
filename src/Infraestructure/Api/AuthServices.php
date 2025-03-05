<?php

namespace Src\Infrastructure\Api;

use Illuminate\Support\Facades\Http;

class AuthService
{
public function getUserFromToken(string $token)
{
$response = Http::withToken($token)->get(env('AUTH_SERVICE_URL') . "/auth/user");
return $response->successful() ? $response->json() : null;
}
}
