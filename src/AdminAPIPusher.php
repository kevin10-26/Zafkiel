<?php

declare(strict_types=1);
$headers = getallheaders();

require __DIR__ . '/../vendor/autoload.php';

use Zafkiel\API\APIChecks;
use Zafkiel\API\AdminPutInterfaceAPI;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $requestBody = (preg_match('/application\/json/i', $_SERVER['CONTENT_TYPE'])) ? json_decode(file_get_contents('php://input'), true) : $_POST;

    // die(var_dump($requestBody['user_data']));

    $userData = (is_string($requestBody['user_data'])) ? json_decode($requestBody['user_data'], true) : $requestBody['user_data'];
    $pictures = (!empty($_FILES)) ? $_FILES['pictures'] : $requestBody['pictures'];

    $userConf = json_decode(file_get_contents('./config/config_routes.json'), true);

    $checker = new APIChecks($userConf);

    if (isset($userData['admin'], $userData['api_key']) && $checker->verify($userData['api_key'])) {

        $adminInterface = new AdminPutInterfaceAPI();

        $targetedAdmin = htmlspecialchars(trim($userData['admin']));
        $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true);

        switch ($userData['options']) {
            case 'push-slideshow-pictures':

                $updatedAdminFile = $adminInterface->pushSlideshowPictures($adminFile, $targetedAdmin, $pictures);
                file_put_contents('./config/zafkiel_admin.json', json_encode($updatedAdminFile, JSON_PRETTY_PRINT));
                break;

            case 'upload-slideshow-picture':

                $updatedAdminFile = $adminInterface->uploadSlideshowPicture($adminFile, $targetedAdmin, $userConf['frontend_components'], $pictures);
                file_put_contents('./config/zafkiel_admin.json', json_encode($updatedAdminFile, JSON_PRETTY_PRINT));
                break;
        }
    }
}
