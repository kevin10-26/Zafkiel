<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

class UpdateSlideshowDTO
{
    public function __construct(
        public int $adminId,
        public array $picturesPaths
    ) {}
}