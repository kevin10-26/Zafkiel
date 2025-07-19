<?php declare(strict_types=1);

namespace Zafkiel\Application\DTOs;

use Zafkiel\Application\DTOs\AdminDTO;

class FetchSlideshowDTO extends AdminDTO
{
    // Separates the default and private pictures from the slideshow
    // To make it easier to display in the frontend.
    public array $detailedPictures;
    
    public function __construct(
        public int $adminId,
        public bool $userPicturesOnly
    ) {}

    public function combinePictures(
        array $default,
        array $private
    ) {
        $this->detailedPictures['default'] = $default;
        $this->detailedPictures['private'] = $private;
    }
}