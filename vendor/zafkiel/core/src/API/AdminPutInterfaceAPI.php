<?php

declare(strict_types=1);

namespace Zafkiel\API;

use \Imagick;

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
    public function __construct($uploadsDir)
    {
        $this->_uploadsDir = $uploadsDir;
    }

    /**
     * @var array $_uploadsDir. Holds the paths to upload stuff (pictures, etc.)
     */
    private array $_uploadsDir;

    /**
     * Mapping des champs du formulaire vers les clés du fichier admin
     */
    private const FIELD_MAPPING = [
        'firstName' => 'additionnal_data.firstName',
        'lastName' => 'additionnal_data.lastName',
        'name' => 'name',
        'email_addr' => 'email_addr',
        'password_hash' => 'password_hash',
        'physical_addr.street' => 'additionnal_data.physical_addr.street',
        'physical_addr.code' => 'additionnal_data.physical_addr.code',
        'physical_addr.city' => 'additionnal_data.physical_addr.city'
    ];

    /**
     * Updates the background pictures preferences for a specific admin.
     * 
     * @param array $adminFile The array of admin data.
     * @param array $data The data to update the background pictures.
     * 
     * @return array The updated admin file with new background picture paths.
     */
    public function updateSlideshowPictures(
        array $adminData,
        array $data
    ): array {
        // Decode URL-encoded paths
        $paths = array_map('urldecode', $data['pictures']);

        // Update the admin's background picture preferences
        $adminData['additionnal_data']['preferences']['backgroundPictures'] = $paths;

        return array(
            'adminData' => $adminData
        );
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
        array $adminData,
        array $data
    ): array {

        $picturesDir = $this->_uploadsDir['pictures'] . 'img/admins/backgrounds/' . $data['adminName'] . '/';

        // Uploads the picture to the server
        $this->uploadPicture($data['files']['picture'], $picturesDir);

        return array(
            'adminData' => $adminData
        );
    }

    public function uploadProfilePicture(
        array $adminData,
        array $data
    ): array {
        $picturesDir = $this->_uploadsDir['pictures'] . 'img/admins/backgrounds/' . $data['adminName'] . '/';

        // Uploads the picture to the server
        $this->uploadPicture($data['files']['picture'], $picturesDir);

        $adminData['additionnal_data']['profile_picture'] = $picturesDir . $data['files']['picture']['name'];

        return array(
            'adminData' => $adminData,
            'flags' => array(
                'profilePicturePath' => $picturesDir . $data['files']['picture']['name']
            )
        );
    }
    /**
     * Updates a value for admins' data.
     * 
     * @param array $array Array to modify
     * @param string $path Path to value in JSON file (e.g.: "additionnal_data.firstName")
     * @param mixed $value New value to set
     * @return array Modified array
     * 
     * @see self::FIELD_MAPPING to see the matching paths
     */
    private function updateNestedValue(array $array, string $path, $value): array
    {
        $keys = explode('.', $path);
        $current = &$array;

        foreach ($keys as $key) {
            if (!isset($current[$key])) {
                $current[$key] = [];
            }
            $current = &$current[$key];
        }

        $current = $value;
        return $array;
    }

    public function pushProfileUpdate(
        array $adminData,
        array $data
    ): array {
        foreach ($data['fields'] as $field => $value) {

            $value = ($field === 'password_hash') ? hash("sha256", $value) : $value;

            if (isset(self::FIELD_MAPPING[$field])) {
                $adminData = $this->updateNestedValue(
                    $adminData,
                    self::FIELD_MAPPING[$field],
                    $value
                );
            }
        }

        return array(
            'adminData' => $adminData
        );
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
        if (!$this->_writeUserImage($picture['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $picturesDir . $filename)) {
            throw new \Exception("Error uploading the file.");
        }
    }

    /**
     * Reduces the compression of the image using Imagick and writes the image in the admin's backgrounds directory
     *
     * @param string $tmpPath The image path.
     * @return string $destPath The destination directory for the image.
     */
    private function _writeUserImage(string $tmpPath, string $destPath): bool
    {
        $imagick = new \Imagick($tmpPath);
        $imagick->setImageCompressionQuality(75);
        $imagick->writeImage($destPath);

        return true;
    }
}
