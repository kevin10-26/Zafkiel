<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

class AdminDTO
{
    public function __construct(
        public int $adminId
    ) {}
}