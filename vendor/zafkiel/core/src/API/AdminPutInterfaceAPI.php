<?php

declare(strict_types=1);

namespace Zafkiel\API;

class AdminPutInterfaceAPI
{
    public function pushSlideshowPictures(
        array $adminFile,
        string $targetedAdmin,
        array $paths
    ): array {

        $paths = array_map(function ($path) {
            return urldecode($path);
        }, $paths);

        $adminFile[$targetedAdmin]['additionnal_data']['preferences']['backgroundPictures'] = $paths;

        return $adminFile;
    }

    public function uploadSlideshowPicture(
        array $adminFile,
        string $targetedAdmin,
        array $picturesDir,
        array $picture
    ): array {

        $this->uploadPicture($picture, $picturesDir['server'] . 'img/admins/backgrounds/' . $targetedAdmin . '/');

        $http = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $picturesDir['url'];

        array_push($adminFile[$targetedAdmin]['additionnal_data']['preferences']['backgroundPictures'], $http . 'img/admins/backgrounds/' . $targetedAdmin . '/' . $picture['name']);

        return $adminFile;
    }

    private function uploadPicture(
        array $picture,
        string $picturesDir
    ): void {
        $allowedExt = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "webp" => "image/webp");

        $filename = $picture["name"];
        $filetype = $picture["type"];
        $filesize = $picture["size"];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!array_key_exists(strtolower($ext), $allowedExt)) die("Please choose a valid extension.");

        $maxsize = 5 * 1024 * 1024; // 5Mo max.
        if ($filesize > $maxsize) die("Error: Your file is too heavy.");

        if (in_array($filetype, $allowedExt)) {

            if (file_exists($picturesDir . $filename)) {
                die("Your file " . $filename . " already exists!");
            } else {

                move_uploaded_file($picture["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $picturesDir . $filename);
            }
        }
    }
}
