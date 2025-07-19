<?php

declare(strict_types=1);

namespace Zafkiel\Presentation\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Zafkiel\Domain\Interfaces\Middlewares\AuthMiddlewareInterface;

class AuthMiddleware implements AuthMiddlewareInterface
{
    private string $privateKey;
    private string $privKeyPassPhrase;
    private string $publicKey = '';

    public function __construct(
        string $pathToPrivateKey,
        string $privKeyPassPhrase,
        string $pathToPublicKey
    ) {
        $this->privateKey = $pathToPrivateKey;
        $this->privKeyPassPhrase = $privKeyPassPhrase;
        $this->publicKey = $pathToPublicKey;
    }

    public function validateToken(string $token): array
    {
        if (!$token) {
            throw new \Exception('Token invalide');
        }

        try {
            // Nettoyer le token
            $token = trim($token);

            // Décoder le token
            $decoded = (array) JWT::decode($token, new Key(file_get_contents($_ENV['PUBLIC_KEY_PATH']), 'RS256'));

            // Vérifier que c'est un token d'accès
            if (!isset($decoded['type']) || $decoded['type'] !== 'access') {
                throw new \Exception('Invalid token type');
            }

            return $decoded;
        } catch (\Exception $e) {
            throw new \Exception('Invalid token: ' . $e->getMessage());
        }
    }

    public function signToken(array $payload): string
    {
        $defaultPayload = [
            "iss" => "http://localhost/zafkiel/",
            "aud" => "http://localhost/zafkiel/",
            "iat" => time(),
            "exp" => time() + 3600,
        ];

        $payload = array_merge($defaultPayload, $payload);

        $keyContent = file_get_contents($_ENV['PRIVATE_KEY_PATH']);
        
        $pKey = openssl_pkey_get_private($keyContent, $_ENV['PRIVATE_KEY_PASSPHRASE']);

        $token = JWT::encode($payload, $pKey, 'RS256');

        return $token;
    }
}