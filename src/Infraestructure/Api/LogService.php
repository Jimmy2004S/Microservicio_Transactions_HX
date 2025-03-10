<?php

namespace Src\Infraestructure\Api;

use Illuminate\Support\Facades\Http;

class LogService
{
    public static string $url = 'https://m7hhhjcc-8000.use.devtunnels.ms/api'; // Asegúrate de definir una URL válida
    public static array $endPoints = [
        'logs' => 'logs'
    ];

    public static function store(string $service, string $type, string $message)
    {

        $url = self::$url . '/' . self::$endPoints['logs'];
        $response = Http::post($url, [
            'service' => $service,
            'type' => $type,
            'payload' => [
                'message' => $message
            ]
        ]);

        return $response->successful() ? $response->json() : null;
    }
}
