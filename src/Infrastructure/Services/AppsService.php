<?php

declare(strict_types=1);

namespace Zafkiel\Infrastructure\Services;

use Doctrine\ORM\EntityManagerInterface;
use Zafkiel\Domain\Entities\ZafkielApps;
use Zafkiel\Domain\Interfaces\Services\AppsServiceInterface;

class AppsService implements AppsServiceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    /**
     * @return array<ZafkielApps>
     */
    public function getApps(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('a')
            ->from(ZafkielApps::class, 'a')
            ->getQuery()
            ->getResult();
    }
}
