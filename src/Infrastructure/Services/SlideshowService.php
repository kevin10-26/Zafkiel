<?php

declare(strict_types=1);

namespace Zafkiel\Infrastructure\Services;

use Zafkiel\Domain\Interfaces\Services\SlideshowServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Zafkiel\Domain\Entities\ZafkielAdmin;
use Zafkiel\Domain\Entities\ZafkielAdminPicture;
use Zafkiel\Domain\Entities\ZafkielPersonalAdmin;
use Zafkiel\Domain\Interfaces\Services\AuthServiceInterface;

use Zafkiel\Infrastructure\Persistence\PictureFileRepository;
use Zafkiel\Infrastructure\Persistence\PictureDoctrineRepository;

use Zafkiel\Application\DTOs\UploadPictureDTO;
use Zafkiel\Application\DTOs\FetchPicturesDTO;
use Zafkiel\Application\DTOs\UpdateSlideshowDTO;
use Zafkiel\Application\DTOs\DeletePictureDTO;

use \Imagick;

class SlideshowService implements SlideshowServiceInterface
{
    public function __construct(
        private PictureFileRepository $pictureFile,
        private PictureDoctrineRepository $pictureDoctrine
    ) {}

    public function fetchPictures(FetchPicturesDTO &$dto)
    {
        $dto->selectedPictures['obj'] = $this->pictureDoctrine->fetch($dto);
        $dto->selectedPictures['paths'] = array_map(
            fn($picture) => $picture->getPicturePath(),
            $dto->selectedPictures['obj']
        );
        
        $dto->selectedPictures['is_public'] = array_reduce(
            $dto->selectedPictures['obj'],
            function($carry, $picture) {
                $carry[$picture->getPicturePath()] = $picture->isPublic();
                return $carry;
            },
            []
        );

        $dto->contextPictures['private'] = $this->getUserPrivatePictures($dto->adminId, $dto->selectedPictures['paths']);

        $defaultPicturesObjects = $this->pictureDoctrine->fetchDefaultObjects();
        
        foreach($defaultPicturesObjects as $picture) {
            $dto->selectedPictures['is_public'][$picture->getPicturePath()] = $picture->isPublic();
        }
        
        $dto->contextPictures['default'] = array_map(
            fn($picture) => $picture->getPicturePath(),
            $defaultPicturesObjects
        );
    }

    public function getPicturesByPath($picturePath)
    {
        $qb = $this->entityManager->createQueryBuilder();
        return $qb->select('p')
            ->from(ZafkielAdminPicture::class, 'p')
            ->where('p.picture_path = :path')
            ->setParameter('path', trim($picturePath))
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getUserPrivatePictures(int $adminId, ?array $selectedPictures = null): array
    {
        $pictures = [];
        $matchingSelectedPictures = [];
        $directory = __DIR__ . '/../../../public/img/admins/' . $adminId . '/backgrounds';
    
        if (!is_dir($directory)) {
            return [];
        }
    
        $files = scandir($directory);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = 'img/admins/' . $adminId . '/backgrounds/' . $file;

                (!empty($selectedPictures) && in_array($filePath, $selectedPictures)) ? array_push($matchingSelectedPictures, $filePath) : array_push($pictures, $filePath);
            }
        }

        sort($matchingSelectedPictures, SORT_STRING);
        $pictures = array_merge($matchingSelectedPictures, $pictures);
    
        return $pictures;
    }

    public function updateUserSlideshowPictures(UpdateSlideshowDTO $dto)
    {
        $this->pictureDoctrine->update($dto);

        return true;
    }

    public function getUserSlideshow(FetchSlideshowDTO $dto)
    {
        $default = $this->pictureDoctrine->fetchDefault();
        $private = $this->pictureDoctrine->fetchPrivate();

        $dto->combinePictures($default, $private);
    }

    /**
     * Uploads a new slideshow picture for a specific admin and updates their preferences.
     * 
     * @param array $adminFile The array of admin data.
     * @param array $data The picture to be processed.
     * 
     * 
     * @return array The updated admin file with new slideshow picture.
     */
    public function uploadPicture(
        int $adminId,
        array $data
    ): array {

        $picture = $this->entityManager->getRepository(ZafkielAdminPicture::class)->find(1);
        if (!$picture) return false;

        $picturesDir = __DIR__ . '/../../../public/img/admins/' . $adminId . '/backgrounds/';

        // Uploads the picture to the server
        $this->movePictureToFolder($data, $picturesDir);

        $picture->addSlideshowPicture($data['name']);
        $this->entityManager->persist();
        $this->entitymanager->flush();

        return 1;
    }

    public function deletePicture(DeletePictureDTO $dto): bool
    {
        $deleteInDB = $this->pictureDoctrine->delete($dto); 
        $deleteInFile = $this->pictureFile->delete($dto->picturePath);

        return $deleteInDB && $deleteInFile;
    }

    public function beginPictureUploadPersistence(UploadPictureDTO $dto)
    {
        $picture = $this->pictureDoctrine->save($dto);
        
        if ($picture) {
            $destination = __DIR__ . '/../../../public/img/admins/' . $dto->adminId . '/backgrounds/';
            $this->pictureFile->upload($destination, $dto->file);
            return $picture;
        }
        return true;
    }
}
