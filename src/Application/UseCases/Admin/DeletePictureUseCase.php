<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Application\DTOs\DeletePictureDTO;
use Zafkiel\Infrastructure\Services\SlideshowService;

class DeletePictureUseCase
{
    public function __construct(
        private readonly SlideshowService $slideshowService
    ) {}

    public function execute(DeletePictureDTO $dto): bool
    {
        return $this->slideshowService->deletePicture($dto);
    }
}