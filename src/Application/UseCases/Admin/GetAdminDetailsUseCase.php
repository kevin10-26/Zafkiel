<?php

declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Application\DTOs\FetchAdminDetailsDTO;
use Zafkiel\Domain\Interfaces\Services\AdminServiceInterface;
use Zafkiel\Infrastructure\Services\SlideshowService;
use Zafkiel\Infrastructure\Services\SessionManagerService;

class GetAdminDetailsUseCase
{
    public function __construct(
        private readonly AdminServiceInterface $adminService,
        private readonly SlideshowService $slideshowService,
        private readonly SessionManagerService $sessionManagerService
    ) {}

    public function execute(FetchAdminDetailsDTO $dto): ?array
    {
        $dto->admins = $this->adminService->getAdmins($dto);

        $dto->setSessionStatusForEachAdmin($this->sessionManagerService);
        
        return $dto->admins;
    }
}
