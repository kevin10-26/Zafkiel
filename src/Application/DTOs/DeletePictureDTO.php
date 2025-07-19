<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

class DeletePictureDTO
{
    public function __construct(
        public int $adminId,
        public string $picturePath
    ) {}
}