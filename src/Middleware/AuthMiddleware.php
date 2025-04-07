<?php

namespace Zafkiel\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
    private static $publicKey;

    public function __construct(string $pubKey)
    {
        self::$publicKey = $pubKey;
    }

    public static function validateToken(string $token)
    {
        if (!$token) return false;

        try {
            $decoded = JWT::decode($token, new Key(self::$publicKey, 'RS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }
}
