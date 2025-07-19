<?php declare(strict_types=1);

namespace Zafkiel\Application\UseCases;

class FileCheckerUseCase
{
    const ALLOWED_EXTENSIONS = [
        "jpg" => "image/jpg",
        "jpeg" => "image/jpeg",
        "gif" => "image/gif",
        "png" => "image/png",
        "webp" => "image/webp"
    ];

    const MAX_FILE_SIZE = 5 * 1024 * 1024;

    protected function checkFile(
        string $path,
        array $picture
    )
    {
        if (empty($picture)) {
            throw new \Exception("Please choose a file.");
        }

        $filename = $picture["name"];
        $filetype = $picture["type"];
        $filesize = $picture["size"];

        // Validate file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists(strtolower($ext), self::ALLOWED_EXTENSIONS)) {
            throw new \Exception("Please choose a valid extension.");
        }

        // Validate file size (max 5MB)
        if ($filesize > self::MAX_FILE_SIZE) {
            throw new \Exception("Error: Your file is too large.");
        }

        // Check if file already exists
        if (file_exists($path  . $filename)) {
            throw new \Exception("Your file " . $filename . " already exists!");
        }

        return true;
    }
}