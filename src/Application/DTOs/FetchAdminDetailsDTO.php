<?php

declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

use Zafkiel\Infrastructure\Services\SessionManagerService;

class FetchAdminDetailsDTO
{
    public array $admins = [];
    
    public function __construct(
        public readonly int $adminId
    ) {}

    public function setSessionStatusForEachAdmin(SessionManagerService $sessionManagerService): void
    {
        if (count($this->admins) > 0) {

            foreach ($this->admins as $admin) {
                $admin->setSessionStatus($sessionManagerService->isUserOnline($admin->getId()));
            }
        }

        // Manually set the session status for the current admin
        $this->admins[$this->adminId]->setSessionStatus(true);
    }
}