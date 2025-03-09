<?php

namespace Src\Infraestructure\Api;

use Exception;
use Illuminate\Support\Facades\Http;

class EmailService
{
    public static string $url = 'https://notifier-micro-service-production.up.railway.app/api'; // Asegúrate de definir una URL válida
    public static array $endPoints = [
        'send' => 'email/send'
    ];

    public static function send(string $to, string $type, array $payload)
    {
        try {
            $url = self::$url . '/' . self::$endPoints['send'];

            $response = Http::post($url, [
                'to' => $to,
                'type' => $type,
                'payload' => [
                    'amount' => $payload['amount'],
                    'type' => $payload['type'],
                ]
            ]);

            return $response->successful() ? $response->json() : null;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
