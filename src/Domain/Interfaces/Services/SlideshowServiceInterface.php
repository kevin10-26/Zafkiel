<?php

declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces\Services;

use Zafkiel\Application\DTOs\FetchPicturesDTO;

interface SlideshowServiceInterface
{
    public function fetchPictures(FetchPicturesDTO &$dto);
}
