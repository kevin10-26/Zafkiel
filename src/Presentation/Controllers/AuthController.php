<?php

declare(strict_types=1);

namespace Zafkiel\Presentation\Controllers;

use Zafkiel\Infrastructure\Services\AuthService;
use Sabre\HTTP\Response;

class AuthController
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function refreshToken(): Response
    {
        if (!isset($_COOKIE['refresh_token'])) {
            $response = new Response(400);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode(['error' => 'Refresh token is required']));
            return $response;
        }

        $newTokens = $this->authService->refreshToken($_COOKIE['refresh_token']);

        if (!$newTokens) {
            $response = new Response(401);
            $response->setHeader('Content-Type', 'application/json');
            $response->setBody(json_encode(['error' => 'Invalid or expired refresh token']));
            return $response;
        }

        $response = new Response(200);
        $response->setHeader('Content-Type', 'application/json');
        $response->setBody($newTokens);
        return $response;
    }
}
