<?php

declare(strict_types=1);

namespace Zafkiel\Infrastructure\Services;

use Doctrine\ORM\EntityManagerInterface;
use Zafkiel\Domain\Entities\ZafkielAdmin;
use Zafkiel\Domain\Entities\RefreshToken;
use Zafkiel\Domain\Interfaces\Services\AuthServiceInterface;
use Zafkiel\Domain\Interfaces\Middlewares\AuthMiddlewareInterface;

class AuthService implements AuthServiceInterface
{
    private array $decodedToken;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private AuthMiddlewareInterface $authMiddleware
    ) {}

    public function verifyToken($token): self
    {
        // Vérifier d'abord le cookie access_token
        if (empty($token) && isset($_COOKIE['access_token'])) {
            $token = $_COOKIE['access_token'];
        }

        $jwt = trim(str_replace('Bearer ', '', $token));

        try {
            $decodedToken = $this->authMiddleware->validateToken($jwt);
            $this->decodedToken = $decodedToken;
            return $this;
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized. ' . $e->getMessage()]);
            exit;
        }
    }

    public function getDecodedToken(): array
    {
        return $this->decodedToken;
    }

    public function isUserValid(): bool
    {
        $userRow = $this->entityManager->createQueryBuilder()
            ->select('a.name')
            ->from(ZafkielAdmin::class, 'a')
            ->where('a.id = :adminId')
            ->setParameter('adminId', $this->decodedToken['adminId'])
            ->getQuery()
            ->getSingleScalarResult();

        return ($userRow) ? true : false;
    }

    public function generateAuthToken(int $adminId): string
    {
        // Générer le token d'accès
        $accessToken = $this->authMiddleware->signToken([
            'adminId' => $adminId,
            'type' => 'access'
        ]);
        // Générer le refresh token
        $refreshToken = bin2hex(random_bytes(32));
        $expiresAt = new \DateTime('+30 days');

        $refreshTokenEntity = new RefreshToken($refreshToken, $adminId, $expiresAt);
        $this->entityManager->persist($refreshTokenEntity);
        $this->entityManager->flush();

        // Définir les cookies
        $this->setAuthCookies($accessToken, $refreshToken);

        return json_encode([
            'token' => $accessToken,
            'expires_in' => 3600 // 1 heure
        ]);
    }

    public function refreshToken(string $refreshToken): ?string
    {
        $tokenEntity = $this->entityManager->getRepository(RefreshToken::class)->find($refreshToken);

        if (!$tokenEntity || $tokenEntity->isExpired()) {
            return null;
        }

        // Supprimer l'ancien refresh token
        $this->entityManager->remove($tokenEntity);
        $this->entityManager->flush();

        // Générer un nouveau token d'accès
        return $this->generateAuthToken($tokenEntity->getAdminId());
    }

    private function setAuthCookies(string $accessToken, string $refreshToken): void
    {
        // Cookie pour le token d'accès (1 heure)
        setcookie('access_token', $accessToken, [
            'expires' => time() + 3600,
            'path' => '/',
            'domain' => $_ENV['COOKIE_DOMAIN'] ?? 'zafkiel.localhost',
            'secure' => $_ENV['COOKIE_SECURE'] ?? false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);

        // Cookie pour le refresh token (30 jours)
        setcookie('refresh_token', $refreshToken, [
            'expires' => time() + (30 * 24 * 3600),
            'path' => '/',
            'domain' => $_ENV['COOKIE_DOMAIN'] ?? 'zafkiel.localhost',
            'secure' => $_ENV['COOKIE_SECURE'] ?? false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);

        // Cookie pour la date d'expiration du token d'accès
        setcookie('token_expires_at', (string)(time() + 3600), [
            'expires' => time() + 3600,
            'path' => '/',
            'domain' => $_ENV['COOKIE_DOMAIN'] ?? 'zafkiel.localhost',
            'secure' => $_ENV['COOKIE_SECURE'] ?? false,
            'httponly' => false,
            'samesite' => 'Strict'
        ]);
    }
}
