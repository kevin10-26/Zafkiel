<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Infrastructure\Services\SlideshowService;

use Zafkiel\Application\DTOs\FetchPicturesDTO;

class FetchPicturesUseCase
{
    public function __construct(
        private readonly SlideshowService $slideshow
    ) {}

    public function execute(FetchPicturesDTO &$dto): FetchPicturesDTO
    {
        $this->slideshow->fetchPictures($dto);

        return $dto;
    }
}