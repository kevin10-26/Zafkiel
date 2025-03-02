<?php

declare(strict_types=1);

// Fetch headers
$headers = getallheaders();

require __DIR__ . '/../vendor/autoload.php';

use Zafkiel\API\APIChecks;
use Zafkiel\API\AdminPutInterfaceAPI;

/**
 * Handles API requests for admin-related actions such as updating slideshow pictures.
 * 
 * @license LGPL-2.1
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Parse the request body based on content type
    $requestBody = (preg_match('/application\/json/i', $_SERVER['CONTENT_TYPE']))
        ? json_decode(file_get_contents('php://input'), true)
        : $_POST;

    // Parse user data (either from JSON or POST data)
    $userData = (is_string($requestBody['user_data']))
        ? json_decode($requestBody['user_data'], true)
        : $requestBody['user_data'];

    // Handle uploaded files or fetch from the request body
    $pictures = (!empty($_FILES)) ? $_FILES['pictures'] : $requestBody['pictures'];

    // Load configuration
    $userConf = json_decode(file_get_contents('./config/config_routes.json'), true);

    // Instantiate API checks class for verifying the API key
    $checker = new APIChecks($userConf);

    // Verify the provided admin and API key
    if (isset($userData['admin'], $userData['api_key']) && $checker->verify($userData['api_key'])) {

        // Instantiate the AdminPutInterfaceAPI for updating admin data
        $adminInterface = new AdminPutInterfaceAPI();

        // Sanitize the targeted admin name
        $targetedAdmin = htmlspecialchars(trim($userData['admin']));

        // Load the admin file
        $adminFile = json_decode(file_get_contents('./config/zafkiel_admin.json'), true);

        // Switch on the options to determine the requested action
        switch ($userData['options']) {

            case 'push-slideshow-pictures':
                // Update slideshow pictures
                $updatedAdminFile = $adminInterface->pushSlideshowPictures($adminFile, $targetedAdmin, $pictures);
                file_put_contents('./config/zafkiel_admin.json', json_encode($updatedAdminFile, JSON_PRETTY_PRINT));
                break;

            case 'upload-slideshow-picture':
                // Upload a new slideshow picture
                $updatedAdminFile = $adminInterface->uploadSlideshowPicture($adminFile, $targetedAdmin, $userConf['frontend_components'], $pictures);
                file_put_contents('./config/zafkiel_admin.json', json_encode($updatedAdminFile, JSON_PRETTY_PRINT));
                break;

            default:
                // Handle invalid options
                die('Invalid option provided.');
                break;
        }
    } else {
        // If verification fails, return an error
        die('Invalid admin or API key.');
    }
}
