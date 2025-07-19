<?php

declare(strict_types=1);

namespace Zafkiel\Infrastructure\Services;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Zafkiel\Domain\Entities\ZafkielAdmin;
use Zafkiel\Domain\Interfaces\Services\AdminServiceInterface;

use Zafkiel\Application\DTOs\SetAdminProfilePictureDTO;
use Zafkiel\Application\DTOs\SetAdminDataProfileDTO;

use Zafkiel\Infrastructure\Persistence\AdminDoctrineRepository;
use Zafkiel\Infrastructure\Persistence\AdminFileRepository;

class AdminService implements AdminServiceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private AdminDoctrineRepository $adminDoctrine,
        private AdminFileRepository $adminFile
    ) {}

    /**
     * With array_reduce, the key of each entity will be the admin's id
     * That way, admins will be able to be selected independently.
     * 
     * @return array<int, ZafkielAdmin>
     */
    public function getAdmins(): array
    {
        $admins = $this->createBaseQuery()
            ->getQuery()
            ->getResult();

        return array_reduce($admins, function ($acc, ZafkielAdmin $admin) {
            $acc[$admin->getId()] = $admin;
            return $acc;
        }, []);
    }

    public function getAdminById(int $id): ?ZafkielAdmin
    {
        return $this->adminDoctrine->findAdmin($id) ?? null;
    }

    public function setAdminProfilePicture(SetAdminProfilePictureDTO $dto)
    {
        if ($this->adminDoctrine->setProfilePicture($dto) && $this->adminFile->setProfilePicture($dto))
        {
            return $dto->picturePath . $dto->profilePicture['name'];
        }
    }

    public function setAdminDataProfile(SetAdminDataProfileDTO $dto)
    {
        if (isset($dto->data['name']))
        {
            rename(
                __DIR__ . '/../../../public/img/admins/' . $dto->adminName . '/',
                __DIR__ . '/../../../public/img/admins/' . $dto->data['name'] . '/'
            );
        }

        return $this->adminDoctrine->setAdminData($dto);
    }

    private function createBaseQuery(): QueryBuilder
    {
        return $this->entityManager->createQueryBuilder()
            ->select('a', 'pd')
            ->from(ZafkielAdmin::class, 'a')
            ->leftJoin('a.personalData', 'pd');
    }
}
