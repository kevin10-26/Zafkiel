<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

use Zafkiel\Application\DTOs\AdminDTO;

class UploadPictureDTO
{
    public function __construct(
        public int $adminId,
        public array $file
    ) {}
}