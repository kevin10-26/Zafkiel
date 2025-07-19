<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces\Middlewares;

interface AuthMiddlewareInterface
{
    public function validateToken(string $token): array;
    public function signToken(array $payload): string;
}
