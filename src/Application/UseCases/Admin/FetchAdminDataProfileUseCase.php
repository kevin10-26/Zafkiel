<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Domain\Entities\ZafkielAdmin;

use Zafkiel\Infrastructure\Services\AdminService;
use Zafkiel\Application\DTOs\FetchAdminDetailsDTO;
use Zafkiel\Infrastructure\Services\SessionManagerService;

class FetchAdminDataProfileUseCase
{
    public function __construct(
        private readonly AdminService $adminService,
        private readonly SessionManagerService $sessionManagerService
    ) {}

    public function execute(FetchAdminDetailsDTO $dto): ?array
    {
        $dto->admins[$dto->adminId] = $this->adminService->getAdminById($dto->adminId);

        $dto->setSessionStatusForEachAdmin($this->sessionManagerService);

        return $dto->admins;
    }
}