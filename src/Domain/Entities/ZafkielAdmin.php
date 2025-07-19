<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @property int|null $id
 * @property string $name
 * @property string $email_addr
 * @property string $password
 * @property string $status
 * @property ZafkielPersonalAdmin|null $personalData
 * @property Collection<int, ZafkielPermissions> $permissions
 */
#[ORM\Entity]
#[ORM\Table(name: 'zafkiel_admin')]
class ZafkielAdmin
{
    #[ORM\Id]
    #[ORM\Column(type: 'bigint')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $email_addr = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $password = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $status = '';

    #[ORM\OneToOne(targetEntity: ZafkielPersonalAdmin::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?ZafkielPersonalAdmin $personalData = null;

    #[ORM\Transient]
    private const SESSION_MAPPING_FRONTEND = [
        'online' => '#016630',
        'offline' => '#9F0712'
    ];

    #[ORM\Transient]
    private array $sessionStatus = [
        'status' => false,
        'color' => self::SESSION_MAPPING_FRONTEND['offline']
    ];

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmailAddr(): string
    {
        return $this->email_addr;
    }

    public function setEmailAddr(string $email_addr): self
    {
        $this->email_addr = $email_addr;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = hash('SHA256', $password);
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getPersonalData(): ?ZafkielPersonalAdmin
    {
        return $this->personalData;
    }

    public function setPersonalData(?ZafkielPersonalAdmin $personalData): self
    {
        if ($this->personalData !== null && $this->personalData !== $personalData) {
            $this->personalData->setUser(null);
        }

        if ($personalData !== null && $personalData->getUser() !== $this) {
            $personalData->setUser($this);
        }

        $this->personalData = $personalData;
        return $this;
    }

    public function getSessionStatus(): array
    {
        return $this->sessionStatus;
    }

    public function setSessionStatus(bool $sessionStatus): self
    {
        $this->sessionStatus['status'] = $sessionStatus;
        $this->sessionStatus['color'] = $sessionStatus ? self::SESSION_MAPPING_FRONTEND['online'] : self::SESSION_MAPPING_FRONTEND['offline'];
        return $this;
    }
}
