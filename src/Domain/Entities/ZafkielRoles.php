<?php declare(strict_types=1);

namespace Zafkiel\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class ZafkielRoles
{
    #[ORM\Id]
    #[ORM\Column(type: 'bigint')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';
    
    #[ORM\Column(type: 'integer')]
    private int $level = 0;

    #[ORM\Column(type: 'string', length: 255)]
    private string $description = '';

    #[ORM\ManyToMany(targetEntity: ZafkielPermissions::class, inversedBy: 'roles')]
    #[ORM\JoinTable(name: 'role_permissions')]
    private Collection $permissions;

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

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(ZafkielPermissions $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
            $permission->setRole($this);
        }
        return $this;
    }

    public function removePermission(ZafkielPermissions $permission): self
    {
        if ($this->permissions->removeElement($permission)) {
            if ($permission->getRole() === $this) {
                $permission->setRole(null);
            }
        }
        return $this;
    }
}