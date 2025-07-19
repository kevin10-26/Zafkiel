<?php

declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Apps;

use Zafkiel\Domain\Interfaces\Services\AppsServiceInterface;

class GetAppsDetailsUseCase
{
    public function __construct(
        private readonly AppsServiceInterface $appsServices
    ) {}

    public function execute(): ?array
    {
        return $this->appsServices->getApps();
    }
}
