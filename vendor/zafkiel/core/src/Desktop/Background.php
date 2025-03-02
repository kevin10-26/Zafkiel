<?php

declare(strict_types=1);

namespace Zafkiel\Desktop;

use Imagick;

/**
 * Class Background
 *
 * This class manages background images, including both default and user-specific backgrounds.
 * It uses Imagick for image compression and provides several methods to retrieve and manipulate background images.
 *
 * @package Zafkiel\Desktop
 */
class Background
{
    private string|array $_base;
    private ?array $_pictures;
    private string $_url;

    /**
     * Background constructor.
     *
     * @param string|array $base Base path for the images.
     * @param array|null $pictures List of custom images (optional).
     */
    public function __construct(string|array $base, ?array $pictures = [])
    {
        $this->_base = $base;
        $this->_pictures = $pictures;
        $this->_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
    }

    /**
     * Retrieves all background pictures.
     *
     * @return $this
     */
    public function getAllPictures(): self
    {
        $this->loadBasePictures();
        return $this;
    }

    /**
     * Retrieves user-specific background pictures.
     *
     * @param string $frontendConf Frontend configuration path.
     * @param string $adminName Administrator name.
     * @return array Array of user-specific background images.
     */
    public function getUserPictures(string $frontendConf, string $adminName): array
    {
        $userPictures = [];
        $pathToAdminsBackgrounds = 'img/admins/backgrounds/' . $adminName;

        $userPictures = array_map(function ($pictureName) use ($frontendConf, $pathToAdminsBackgrounds) {
            $relPath = '/' . $frontendConf . $pathToAdminsBackgrounds;
            return $this->buildData($this->getHTTPPath($pictureName, $relPath));
        }, glob($_SERVER['DOCUMENT_ROOT'] . $frontendConf . $pathToAdminsBackgrounds . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE));

        return $userPictures;
    }

    /**
     * Sets custom background pictures.
     *
     * @param array $pictures List of new custom background images.
     * @return $this
     */
    public function setPictures(array $pictures): self
    {
        $this->_pictures = $pictures;
        return $this;
    }

    /**
     * Retrieves the default background pictures.
     *
     * @return array List of default background images.
     */
    public function getDefaultPictures(): array
    {
        $pictures = glob(__DIR__ . '/../Templates/img/backgrounds/pictures/*.{jpg,jpeg}', GLOB_BRACE);
        return $this->getPicturesData($pictures);
    }

    /**
     * Retrieves data associated with the specified pictures.
     *
     * @param array $pictures List of image paths.
     * @return array List of images with their associated data.
     */
    public function getPicturesData(array $pictures): array
    {
        return array_map(function ($picture) {
            if (in_array(pathinfo($picture, PATHINFO_EXTENSION), ['jpg', 'png', 'gif', 'jpeg'])) {
                $currentFilename = pathinfo($picture, PATHINFO_FILENAME);
                $pictureData = $this->getPictureData($currentFilename);
                $pictureUrl = (preg_match('/^http/i', $picture) === 0) ? $this->getHTTPPath($picture) : $picture;
                return $this->buildData($pictureUrl, $pictureData);
            }
            return null;
        }, $pictures);
    }

    /**
     * Generates the HTTP path for the image.
     *
     * @param string $picturePath Absolute path to the image.
     * @param string $pathToBackgrounds Optional relative path to the backgrounds.
     * @return string HTTP path to the image.
     */
    private function getHTTPPath(string $picturePath, string $pathToBackgrounds = ""): string
    {
        $basePath = empty($pathToBackgrounds)
            ? '/vendor/zafkiel/core/src/Templates/img/backgrounds/pictures/' . basename($picturePath)
            : $pathToBackgrounds . '/' . basename($picturePath);

        return $this->_url . $basePath;
    }

    /**
     * Builds an associative array for an image with its metadata.
     *
     * @param string $picture The image path.
     * @param array $pictureData Data associated with the image.
     * @return array Structured data array.
     */
    private function buildData(string $picture, array $pictureData = []): array
    {
        return [
            'path'     => preg_match('/^http/i', $picture) ? urldecode($picture) : $this->_url . '/' . urldecode($picture),
            'filename' => urldecode(basename($picture)),
            'picture'  => $this->reducePictureCompression($picture),
            'data'     => $pictureData
        ];
    }

    /**
     * Reduces the compression of the image using Imagick and returns the image as a base64-encoded string.
     *
     * @param string $picture The image path.
     * @return string The base64-encoded image.
     */
    private function reducePictureCompression(string $picture): string
    {
        $pathToPicture = preg_match('/^http/i', $picture)
            ? $_SERVER['DOCUMENT_ROOT'] . substr(parse_url($picture, PHP_URL_PATH), 1)
            : $picture;

        $imagick = new Imagick($pathToPicture);
        $imagick->thumbnailImage(300, 200, true);

        return base64_encode($imagick->getImageBlob());
    }

    /**
     * Loads the base background pictures from the specified base directory.
     */
    private function loadBasePictures(): void
    {
        $pictures = glob($this->_base . '/pictures/*.jpg');
        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on" ? 'https://' : 'http://';
        $this->_pictures = array_map(function ($pictureName) use ($http) {
            return $http . $_SERVER['SERVER_NAME'] . '/vendor/zafkiel/core/src/Templates/img/backgrounds/pictures/' . basename($pictureName);
        }, $pictures);
    }

    /**
     * Retrieves the data associated with an image based on its filename.
     *
     * @param string $filename The image filename without extension.
     * @return array The image metadata.
     */
    private function getPictureData(string $filename): array
    {
        $dataFilePath = __DIR__ . '/../Templates/img/backgrounds/facts/data_' . $filename . '.json';
        if (file_exists($dataFilePath)) {
            return json_decode(file_get_contents($dataFilePath), true);
        }
        return [];
    }
}
