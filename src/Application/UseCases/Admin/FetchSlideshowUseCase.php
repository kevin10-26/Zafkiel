<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Application\DTOs\FetchSlideshowDTO;

use Zafkiel\Infrastructure\Services\SlideshowService;

class FetchSlideshowUseCase
{
    public function __construct(
        private readonly SlideshowService $slideshow
    ) {}

    public function execute(FetchSlideshowDTO &$dto): FetchSlideshowDTO
    {
        $this->slideshow->getUserSlideshow($dto);

        return $dto;
    }
}