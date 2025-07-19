<?php declare(strict_types=1);

namespace Zafkiel\Infrastructure\Persistence;

use \Imagick;

class PictureFileRepository
{
    public function upload(string $destination, array $file): bool
    {
        $imagick = new \Imagick($file['tmp_name']);
        $imagick->setImageCompressionQuality(75);
        $imagick->writeImage($destination . $file['name']);

        return true;
    }

    public function delete(string $filePath): bool
    {
        return (file_exists($filePath)) ? unlink($filePath) : false;
    }
}