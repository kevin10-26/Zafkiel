<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces\Services;

interface AuthServiceInterface
{
    public function verifyToken($token): self;
    public function isUserValid(): bool;
    public function generateAuthToken(int $adminId): string;
    public function refreshToken(string $refreshToken): ?string;
    public function getDecodedToken(): array;
}
