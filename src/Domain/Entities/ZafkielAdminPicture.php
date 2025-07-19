<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'zafkiel_admin_picture')]
class ZafkielAdminPicture
{

    #[ORM\Id]
    #[ORM\Column(type: 'bigint')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $picture_path = '';

    #[ORM\ManyToMany(targetEntity: ZafkielPersonalAdmin::class, mappedBy: 'slideshowPictures')]
    private Collection $personalAdmins;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $is_public = false;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $facts = [];

    public function __construct()
    {
        $this->facts = [];
        $this->personalAdmins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicturePath(): string
    {
        return $this->picture_path;
    }

    public function setPicturePath(string $picture_path): self
    {
        $this->picture_path = $picture_path;
        return $this;
    }

    public function isPublic(): bool
    {
        return $this->is_public;
    }

    public function setIsPublic(bool $is_public): self
    {
        $this->is_public = $is_public;
        return $this;
    }

    public function getFacts(): array
    {
        return $this->facts ?? [];
    }

    public function setFacts(?array $facts): self
    {
        $this->facts = $facts ?? [];
        return $this;
    }

    public function getPersonalAdmins(): Collection
    {
        return $this->personalAdmins;
    }

    public function addPersonalAdmin(ZafkielPersonalAdmin $personalAdmin): self
    {
        if (!$this->personalAdmins->contains($personalAdmin)) {
            $this->personalAdmins->add($personalAdmin);
            $personalAdmin->addSlideshowPicture($this);
        }
        return $this;
    }

    public function removePersonalAdmin(ZafkielPersonalAdmin $personalAdmin): self
    {
        if ($this->personalAdmins->removeElement($personalAdmin)) {
            $personalAdmin->removeSlideshowPicture($this);
        }
        return $this;
    }
}
