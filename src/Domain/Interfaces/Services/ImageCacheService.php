<?php declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces\Services;

interface CacheService
{
    public function getAdminPictures(FetchAdminPicturesDTO $dto): array;
    public function getDefaultPictures(): array;
    public function invalidateCache(string $adminId = null): void;
}