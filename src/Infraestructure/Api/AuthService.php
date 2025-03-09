<?php

namespace Src\Infraestructure\Api;


use Illuminate\Support\Facades\Http;

class AuthService
{
    public static string $url = 'https://6670-181-68-212-252.ngrok-free.app/api'; // Asegúrate de definir una URL válida
    public static array $endPoints = [
        'validate-token' => 'validate-token'
    ];

    public static function getUserFromToken(string $token)
    {

        $url = self::$url . '/' . self::$endPoints['validate-token'];


        return Http::withHeaders([
            'Authorization' => $token,
        ])->get($url);

        // return $response->successful() ? $response->json() : null;
    }
}
