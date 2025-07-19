<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'zafkiel_physical_address_admin')]
class ZafkielPhysicalAddressAdmin
{
    #[ORM\Id]
    #[ORM\OneToOne(targetEntity: ZafkielAdmin::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?ZafkielAdmin $userId = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $street = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $zip = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $city = '';

    public function getUserId(): ?ZafkielAdmin
    {
        return $this->userId;
    }

    public function setUserId(?ZafkielAdmin $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }
}
