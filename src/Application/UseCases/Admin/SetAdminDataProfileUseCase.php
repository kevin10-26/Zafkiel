<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Application\DTOs\SetAdminDataProfileDTO;

use Zafkiel\Infrastructure\Services\AdminService;

class SetAdminDataProfileUseCase
{
    public function __construct(
        private readonly AdminService $adminService
    ) {}

    public function execute(SetAdminDataProfileDTO $dto): bool
    {
        return $this->adminService->setAdminDataProfile($dto);
    }
}