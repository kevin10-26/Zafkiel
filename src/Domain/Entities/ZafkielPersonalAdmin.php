<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'zafkiel_personal_admin')]
class ZafkielPersonalAdmin
{
    #[ORM\Id]
    #[ORM\Column(type: 'bigint')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: ZafkielAdmin::class, inversedBy: 'personalData')]
    #[ORM\JoinColumn(name: 'user', referencedColumnName: 'id', nullable: false)]
    private ?ZafkielAdmin $user = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $firstName = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $lastName = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $profilePicture = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $street = '';

    #[ORM\Column(type: 'string', length: 10)]
    private string $postalCode = '';

    #[ORM\Column(type: 'string', length: 255)]
    private string $city = '';

    #[ORM\ManyToMany(targetEntity: ZafkielAdminPicture::class, inversedBy: 'personalAdmins', cascade: ['persist', 'remove'])]
    #[ORM\JoinTable(name: 'personal_slideshow_pictures')]
    private Collection $slideshowPictures;

    public function __construct()
    {
        $this->slideshowPictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?ZafkielAdmin
    {
        return $this->user;
    }

    public function setUser(?ZafkielAdmin $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getProfilePicture(): string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;
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

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;
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

    public function getSlideshowPictures(): Collection
    {
        return $this->slideshowPictures;
    }

    public function addSlideshowPicture(ZafkielAdminPicture $picture): self
    {
        if (!$this->slideshowPictures->contains($picture)) {
            $this->slideshowPictures->add($picture);
        }
        return $this;
    }

    public function removeSlideshowPicture(ZafkielAdminPicture $picture): self
    {
        $this->slideshowPictures->removeElement($picture);
        return $this;
    }
}
