<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Zafkiel\API\APIChecks;
use Zafkiel\API\AdminFetchInterfaceAPI;

$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? 'https://' : 'http://';

$userConf = json_decode(file_get_contents('./config/config_routes.json'), true);

$checker = new APIChecks($userConf);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['api_key']) && $checker->verify($_POST['api_key'])) {
    // Return this from an API Checks function?
    $currentAdminInfo = array(
        'name'   => htmlspecialchars(trim($_POST['admin'])),
        'apiKey' => htmlspecialchars($_POST['api_key'])
    );

    switch ($_POST['options']) {
        case 'admins-monitoring':

            $targetedAdmin = htmlspecialchars(trim($_POST['admin']));
            $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true);
            $api = new AdminFetchInterfaceAPI($currentAdminInfo);

            echo $api->getDataForAdminStatus($adminFile, $targetedAdmin);
            break;

        case 'slideshow-pictures':

            $targetedAdmin = htmlspecialchars(trim($_POST['admin']));
            $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true)[$targetedAdmin];
            $api = new AdminFetchInterfaceAPI($currentAdminInfo, __DIR__ . '/../vendor/');

            echo $api->getDataForAdminSlideshow($userConf['pictures'], $adminFile);
            break;

        case 'user-pictures':

            $pictures = json_decode($_POST['pictures'], true);
            $targetedAdmin = htmlspecialchars(trim($_POST['admin']));
            $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true)[$targetedAdmin];
            $paths = json_decode(file_get_contents('./config/config_routes.json'), true)['pictures'];
            $api = new AdminFetchInterfaceAPI($currentAdminInfo, __DIR__ . '/../vendor/');

            echo $api->getDataForUserPictures($adminFile, $paths, $pictures);
            break;

        default:
            die('here');
            break;
    }
}
