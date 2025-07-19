<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases\Admin;

use Zafkiel\Application\UseCases\FileCheckerUseCase;

use Zafkiel\Infrastructure\Services\SlideshowService;

use Zafkiel\Application\DTOs\UploadPictureDTO;

class UploadPictureUseCase extends FileCheckerUseCase
{
    public function __construct(
        private SlideshowService $slideshow
    ) {}

    public function execute(UploadPictureDTO $dto): bool
    {
        $destination = __DIR__ . '/../../../../public/img/admins/' . $dto->adminId . '/backgrounds/';
        if ($this->checkFile($destination, $dto->file) && $this->slideshow->beginPictureUploadPersistence($dto))
        {
            return true;
        }

        return false;
    }
}