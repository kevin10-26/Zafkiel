<?php declare(strict_types=1);

namespace Zafkiel\Infrastructure\Persistence;

use Zafkiel\Application\DTOs\SetAdminProfilePictureDTO;

class AdminFileRepository
{
    public function setProfilePicture(SetAdminProfilePictureDTO $dto)
    {
        $picturePath = __DIR__ . '/../../../public/img/admins/' . $dto->adminName . '/profile_pictures/' . $dto->profilePicture['name'];

        if (file_exists($picturePath)) {
            unlink($picturePath);
        }

        move_uploaded_file($dto->profilePicture['tmp_name'], $picturePath);

        return $picturePath;
    }
}