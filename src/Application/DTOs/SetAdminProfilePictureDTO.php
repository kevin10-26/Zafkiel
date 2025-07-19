<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

class SetAdminProfilePictureDTO
{
    public string $picturePath = '';

    public function __construct(
        public int $adminId,
        public array $profilePicture
    ) {}
}