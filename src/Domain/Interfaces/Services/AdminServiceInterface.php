<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces\Services;

use Zafkiel\Domain\Entities\ZafkielAdmin;

interface AdminServiceInterface
{
    /**
     * @return array<int, ZafkielAdmin>
     */
    public function getAdmins(): array;
}
