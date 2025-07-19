<?php declare(strict_types=1);

namespace Zafkiel\Infrastructure\Persistence;

use Zafkiel\Application\DTOs\UploadPictureDTO;
use Zafkiel\Application\DTOs\FetchPicturesDTO;
use Zafkiel\Application\DTOs\UpdateSlideshowDTO;
use Zafkiel\Application\DTOs\DeletePictureDTO;

use Zafkiel\Domain\Entities\ZafkielAdminPicture;

use Doctrine\ORM\EntityManagerInterface;

class PictureDoctrineRepository
{
    public function __construct
    (
        private EntityManagerInterface $entityManager
    ) {}

    public function fetch(FetchPicturesDTO $dto): array
    {
        $admin = $this->entityManager->getRepository(\Zafkiel\Domain\Entities\ZafkielAdmin::class)
            ->findOneBy(['id' => $dto->adminId]);

        if (!$admin) {
            return [];
        }

        $personalAdmin = $admin->getPersonalData();
        if (!$personalAdmin) {
            return [];
        }

        return $personalAdmin->getSlideshowPictures()->toArray();
    }

    public function fetchDefault(): array
    {
        $defaultPictures = $this->entityManager->getRepository(ZafkielAdminPicture::class)
            ->findBy(['is_public' => true]);

        return array_map(
            function ($picture) {
                return $picture->getPicturePath();
            },
            $defaultPictures
        );
    }

    public function fetchDefaultObjects(): array
    {
        return $this->entityManager->getRepository(ZafkielAdminPicture::class)
            ->findBy(['is_public' => true]);
    }

    public function save(UploadPictureDTO $dto): ?ZafkielAdminPicture
    {
        $picture = new ZafkielAdminPicture();
        $picture->setPicturePath('img/admins/' . $dto->adminId . '/backgrounds/' . $dto->file['name']);
        $picture->setIsPublic(false);

        $this->entityManager->persist($picture);
        $this->entityManager->flush();

        return $picture;
    }

    public function update(UpdateSlideshowDTO $dto): bool
    {
        $admin = $this->entityManager->getRepository(\Zafkiel\Domain\Entities\ZafkielAdmin::class)
            ->findOneBy(['id' => $dto->adminId]);

        if (!$admin) {
            return false;
        }

        $personalAdmin = $admin->getPersonalData();
        if (!$personalAdmin) {
            return false;
        }
        
        // Récupérer toutes les images actuelles pour pouvoir les supprimer
        $currentPictures = $personalAdmin->getSlideshowPictures()->toArray();
        
        // Supprimer toutes les images actuelles de la collection
        foreach ($currentPictures as $currentPicture) {
            $personalAdmin->removeSlideshowPicture($currentPicture);
        }

        // Ajouter uniquement les nouvelles images sélectionnées
        foreach ($dto->picturesPaths as $picturePath) {
            $picture = $this->entityManager->getRepository(ZafkielAdminPicture::class)
                ->findOneBy(['picture_path' => $picturePath]);

            if (!$picture) {
                $picture = new ZafkielAdminPicture();
                $picture->setPicturePath($picturePath);
                $this->entityManager->persist($picture);
            }
            
            $personalAdmin->addSlideshowPicture($picture);
        }

        $this->entityManager->persist($personalAdmin);
        $this->entityManager->flush();

        return true;
    }

    public function delete(DeletePictureDTO $dto): bool
    {
        $picture = $this->entityManager->getRepository(ZafkielAdminPicture::class)
            ->findOneBy(['picture_path' => $dto->picturePath]);
        
        if (!$picture) {
            return false;
        }

        $this->entityManager->remove($picture);
        $this->entityManager->flush();

        return true;
    }
}