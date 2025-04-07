<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Zafkiel\API\APIChecks;
use Zafkiel\API\AdminFetchInterfaceAPI;

/**
 * Handles API interactions for admin-related actions like monitoring, slideshow pictures, and user pictures.
 * 
 * @license LGPL-2.1
 */

// Get the base URL scheme
$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") ? 'https://' : 'http://';

// Load user configuration
$userConf = json_decode(file_get_contents('./config/config_routes.json'), true);

// Instantiate the APIChecks class for verifying API keys
$checker = new APIChecks($userConf);

// Process POST requests if the correct parameters are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['api_key']) && $checker->verify($_POST['api_key'])) {

    // Sanitize and prepare the admin data
    $currentAdminInfo = [
        'name'   => htmlspecialchars(trim($_POST['admin'])),
        'apiKey' => htmlspecialchars($_POST['api_key'])
    ];

    // Switch based on the 'options' parameter in the POST request
    switch ($_POST['options']) {

        case 'admins-monitoring':
            // Admin monitoring
            $targetedAdmin = htmlspecialchars(trim($_POST['admin']));
            $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true);
            $api = new AdminFetchInterfaceAPI($currentAdminInfo);

            // Output the monitoring data
            echo $api->getDataForAdminStatus($adminFile, $targetedAdmin);
            break;

        case 'slideshow-pictures':
            // Slideshow pictures for admin
            $targetedAdmin = htmlspecialchars(trim($_POST['admin']));
            $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true)[$targetedAdmin];
            $api = new AdminFetchInterfaceAPI($currentAdminInfo, __DIR__ . '/../vendor/');

            // Output the slideshow pictures data
            echo $api->getDataForAdminSlideshow($userConf['pictures'], $adminFile);
            break;

        case 'user-pictures':
            // User pictures for admin
            $pictures = json_decode($_POST['pictures'], true);
            $targetedAdmin = htmlspecialchars(trim($_POST['admin']));
            $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true)[$targetedAdmin];
            $paths = json_decode(file_get_contents('./config/config_routes.json'), true)['pictures'];
            $api = new AdminFetchInterfaceAPI($currentAdminInfo, __DIR__ . '/../vendor/');

            // Output the user pictures data
            echo $api->getDataForUserPictures($adminFile, $paths, $pictures);
            break;

        default:
            // If no valid options, return an error
            die('Invalid option.');
            break;
    }
} else {
    // If API key verification fails, return an error
    die('Invalid or missing API key.');
}
