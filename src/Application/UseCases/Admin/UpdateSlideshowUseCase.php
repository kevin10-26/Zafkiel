<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Application\DTOs\UpdateSlideshowDTO;

use Zafkiel\Infrastructure\Services\SlideshowService;

class UpdateSlideshowUseCase
{
    public function __construct(
        private readonly SlideshowService $slideshow
    ) {}

    public function execute(UpdateSlideshowDTO &$dto): UpdateSlideshowDTO
    {
        $this->slideshow->updateUserSlideshowPictures($dto);

        return $dto;
    }
}