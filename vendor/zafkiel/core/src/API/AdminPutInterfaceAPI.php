<?php

declare(strict_types=1);

namespace Zafkiel\API;

/**
 * AdminPutInterfaceAPI handles operations related to updating and uploading admin slideshow pictures.
 * 
 * This class includes methods for pushing and uploading pictures to a specific admin's slideshow preferences.
 * It also provides a utility for uploading pictures and validating their types and sizes.
 *
 * @license LGPL-2.1
 */
class AdminPutInterfaceAPI
{
    /**
     * Updates the background pictures preferences for a specific admin.
     * 
     * @param array $adminFile The array of admin data.
     * @param string $targetedAdmin The admin whose preferences are being updated.
     * @param array $paths The list of paths to the background pictures.
     * 
     * @return array The updated admin file with new background picture paths.
     */
    public function pushSlideshowPictures(
        array $adminFile,
        string $targetedAdmin,
        array $paths
    ): array {
        // Decode URL-encoded paths
        $paths = array_map('urldecode', $paths);

        // Update the admin's background picture preferences
        $adminFile[$targetedAdmin]['additionnal_data']['preferences']['backgroundPictures'] = $paths;

        return $adminFile;
    }

    /**
     * Uploads a new slideshow picture for a specific admin and updates their preferences.
     * 
     * @param array $adminFile The array of admin data.
     * @param string $targetedAdmin The admin whose slideshow is being updated.
     * @param array $picturesDir The directory information for picture storage.
     * @param array $picture The picture file data.
     * 
     * @return array The updated admin file with new slideshow picture.
     */
    public function uploadSlideshowPicture(
        array $adminFile,
        string $targetedAdmin,
        array $picturesDir,
        array $picture
    ): array {
        // Upload the picture to the server
        $this->uploadPicture($picture, $picturesDir['server'] . 'img/admins/backgrounds/' . $targetedAdmin . '/');

        // Construct the HTTP URL for the uploaded picture
        $http = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $picturesDir['url'];

        // Add the new picture URL to the admin's slideshow preferences
        array_push($adminFile[$targetedAdmin]['additionnal_data']['preferences']['backgroundPictures'], $http . 'img/admins/backgrounds/' . $targetedAdmin . '/' . $picture['name']);

        return $adminFile;
    }

    /**
     * Handles the actual file upload process, validating the file extension and size.
     * 
     * @param array $picture The picture file data.
     * @param string $picturesDir The directory where the picture should be uploaded.
     * 
     * @return void
     * 
     * @throws \Exception If the file extension is not allowed or the file size is too large.
     */
    private function uploadPicture(
        array $picture,
        string $picturesDir
    ): void {
        $allowedExt = [
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png",
            "webp" => "image/webp"
        ];

        $filename = $picture["name"];
        $filetype = $picture["type"];
        $filesize = $picture["size"];

        // Validate file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists(strtolower($ext), $allowedExt)) {
            throw new \Exception("Please choose a valid extension.");
        }

        // Validate file size (max 5MB)
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            throw new \Exception("Error: Your file is too large.");
        }

        // Check if file already exists
        if (file_exists($picturesDir . $filename)) {
            throw new \Exception("Your file " . $filename . " already exists!");
        }

        // Move the uploaded file to the specified directory
        if (!move_uploaded_file($picture["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $picturesDir . $filename)) {
            throw new \Exception("Error uploading the file.");
        }
    }
}
