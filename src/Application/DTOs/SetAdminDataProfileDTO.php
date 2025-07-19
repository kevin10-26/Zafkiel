<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

class SetAdminDataProfileDTO
{
    public function __construct(
        public int $adminId,
        public array $data
    ) {}
}
