<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces\Services;

use Zafkiel\Domain\Entities\ZafkielApps;

interface AppsServiceInterface
{
    /**
     * @return array<ZafkielApps>
     */
    public function getApps(): array;
}
