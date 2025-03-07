<?php

namespace Src\Infrastructure\Api;

use Illuminate\Support\Facades\Http;

class AuthService
{
    public static string $url = 'https://api.example.com'; // Asegúrate de definir una URL válida
    public static array $endPoints = [
        'validateToken' => 'auth/validate-token'
    ];

    public static function getUserFromToken(string $token)
    {

        $url = self::$url . '/' . self::$endPoints['validateToken'];

        $response = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get($url);

        return $response->successful() ? $response->json() : null;
    }
}
