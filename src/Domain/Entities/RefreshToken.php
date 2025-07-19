<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'refresh_tokens')]
class RefreshToken
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 255)]
    private string $token;

    #[ORM\Column(type: 'integer')]
    private int $adminId;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $expiresAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    public function __construct(string $token, int $adminId, \DateTime $expiresAt)
    {
        $this->token = $token;
        $this->adminId = $adminId;
        $this->expiresAt = $expiresAt;
        $this->createdAt = new \DateTime();
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function isExpired(): bool
    {
        return $this->expiresAt < new \DateTime();
    }
}
