<?php declare(strict_types=1);

namespace Zafkiel\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

class ZafkielPermissions
{
    #[ORM\Id]
    #[ORM\Column(type: 'bigint')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $description = '';

    #[ORM\ManyToMany(targetEntity: ZafkielRoles::class, inversedBy: 'permissions')]
    #[ORM\JoinTable(name: 'role_permissions')]
    private Collection $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
}