<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Application\UseCases\FileCheckerUseCase;

use Zafkiel\Application\DTOs\SetAdminProfilePictureDTO;
use Zafkiel\Infrastructure\Services\AdminService;

class SetAdminProfilePictureUseCase extends FileCheckerUseCase
{
    public function __construct(
        private readonly AdminService $adminService
    ) {}

    public function execute(SetAdminProfilePictureDTO $dto): string | false
    {
        if ($this->checkPicture($dto->picturePath, $dto->profilePicture)) {
            return $this->adminService->setAdminProfilePicture($dto);
        }

        return false;
    }
}