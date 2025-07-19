<?php declare(strict_types=1);

namespace Zafkiel\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;

use Zafkiel\Domain\Entities\ZafkielAdmin;
use Zafkiel\Application\DTOs\SetAdminDataProfileDTO;
use Zafkiel\Application\DTOs\SetAdminProfilePictureDTO;

class AdminDoctrineRepository
{
    /**
     * Maps JSON fields to their corresponding entity setters
     * This mapping corresponds to the client-side fieldMapping in admin_profile.conf.js
     */
    private const SERVER_FIELD_MAPPING = [
        'firstName' => ['entity' => 'personalData', 'method' => 'setFirstName'],
        'lastName' => ['entity' => 'personalData', 'method' => 'setLastName'],
        'name' => ['entity' => 'admin', 'method' => 'setName'],
        'email_addr' => ['entity' => 'admin', 'method' => 'setEmailAddr'],
        'password_hash' => ['entity' => 'admin', 'method' => 'setPassword'],
        'physical_addr.street' => ['entity' => 'personalData', 'method' => 'setStreet'],
        'physical_addr.code' => ['entity' => 'personalData', 'method' => 'setPostalCode'],
        'physical_addr.city' => ['entity' => 'personalData', 'method' => 'setCity'],
    ];

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function findAdmin(int $id): ZafkielAdmin
    {
        return $this->entityManager->getRepository(ZafkielAdmin::class)->findOneBy(['id' => $id]);
    }

    public function setProfilePicture(SetAdminProfilePictureDTO $dto)
    {
        $admin = $this->entityManager->getRepository(ZafkielAdmin::class)->findOneBy(['name' => $dto->adminName]);
        $personalAdmin = $admin->getPersonalData();

        $personalAdmin->setProfilePicture($dto->picturePath . $dto->profilePicture['name']);

        $this->entityManager->persist($personalAdmin);
        $this->entityManager->flush();
        return $personalAdmin;
    }

    public function setAdminData(SetAdminDataProfileDTO $dto)
    {
        $admin = $this->entityManager->getRepository(ZafkielAdmin::class)->findOneBy(['name' => $dto->adminName]);
        $personalAdmin = $admin->getPersonalData();

        foreach ($dto->data as $key => $value) {
            if (isset(self::SERVER_FIELD_MAPPING[$key])) {
                $mapping = self::SERVER_FIELD_MAPPING[$key];
                $entity = $mapping['entity'] === 'admin' ? $admin : $personalAdmin;
                $method = $mapping['method'];
                $entity->$method($value);
            }
        }

        $this->entityManager->persist($admin);
        $this->entityManager->persist($personalAdmin);
        $this->entityManager->flush();

        return $personalAdmin;
    }
}