<?php

declare(strict_types=1);

namespace Zafkiel\API;

use Zafkiel\Desktop\Background;
use Zafkiel\Desktop\TwigRenderer;

/**
 * AdminFetchInterfaceAPI is responsible for fetching and rendering admin-related data.
 * 
 * This class handles the retrieval of admin status, slideshow preferences, and user picture settings.
 * It uses the Background class to manage background pictures and the TwigRenderer to render templates.
 *
 * @license LGPL-2.1
 */
class AdminFetchInterfaceAPI
{
    /**
     * @var array Contains the admin information.
     */
    public array $adminInfo;

    /**
     * AdminFetchInterfaceAPI constructor.
     * 
     * @param array $adminInfo Information about the admin.
     */
    public function __construct(array $adminInfo)
    {
        $this->adminInfo = $adminInfo;
    }

    /**
     * Retrieves data for the targeted admin's status and renders the monitoring template.
     * 
     * @param array $adminsFile List of all admins.
     * @param string $targetedAdmin The admin whose data is being fetched.
     * 
     * @return string Rendered admin status template.
     */
    public function getDataForAdminStatus(
        array $adminsFile,
        string $targetedAdmin
    ): string {
        $adminData = [
            "name"                => $adminsFile[$targetedAdmin]['name'],
            "status"              => $adminsFile[$targetedAdmin]['status'],
            "currentAdminSession" => $this->getAdminByKey($adminsFile)
        ];

        return $this->renderAdminData($adminData, 'monitoring/adminsMonitoring.html');
    }

    /**
     * Retrieves and renders the slideshow preferences for the targeted admin.
     * 
     * @param string $userConf The routes conf for the slideshow pictures.
     * @param array $token The JWT containing the admin's essentiel data (name, role)
     * 
     * @return string Rendered slideshow preferences template.
     */
    public function slideshowPictures(
        string $userConf,
        array $adminData
    ): string {
        $background = new Background([]);

        $urlToAdminData = $userConf . 'img/admins/backgrounds/' . $adminData['name'] . '/';

        // If no user pictures, default pictures are returned
        $adminData['slideshow_pictures'] = [
            "default_pictures" => $background->getDefaultPictures($urlToAdminData),
            "user_pictures"    => $background->getUserPictures($userConf, $adminData['name'])
        ];

        $adminData['slideshow_pictures']['default_pictures'] = $this->_sortPictures($adminData['slideshow_pictures']['default_pictures']);

        return $this->renderAdminData($adminData, 'settings/admin_slideshow_preferences.html');
    }

    /**
     * Retrieves and renders the user pictures data for the admin.
     * 
     * @param array $adminData The admin's data.
     * @param string $frontendRoutes The frontend routes configuration.
     * @param array $pictures List of current pictures.
     * 
     * @return string Rendered user pictures template.
     */
    public function userPictures(
        string $frontendRoutes,
        array $adminData
    ): string {
        $background = new Background('');

        $galleryPictures = $background->getUserPictures($frontendRoutes, $adminData['name']);

        $picturesManagement = array('user_pictures' => []);
        $matchedPictures = [];
        $unmatchedPictures = [];

        // Filter and map the new pictures
        foreach (array_column($galleryPictures, 'path') as $path) {
            $pictureData = [
                'path'     => $path,
                'filename' => basename($path)
            ];

            if (in_array($path, $adminData['additionnal_data']['preferences']['backgroundPictures'])) {
                array_push($matchedPictures, $pictureData);
            } else {
                array_push($unmatchedPictures, $pictureData);
            }
        }

        $picturesManagement['user_pictures'] = array_merge($matchedPictures, $unmatchedPictures);
        $picturesManagement['additionnal_data'] = $adminData['additionnal_data'];

        return $this->renderAdminData($picturesManagement, 'settings/admin_user_pictures.html');
    }

    /**
     * Renders the admin data using the Twig template engine.
     * 
     * @param array $data The data to be rendered.
     * @param string $filename The template filename to render.
     * 
     * @return string The rendered template content.
     */
    private function renderAdminData(
        array $data,
        string $filename
    ): string {
        $renderer = new TwigRenderer(__DIR__ . '/../Templates/');
        return $renderer->render('html/components/' . $filename, $data);
    }

    /**
     * Sorts the pictures by country.
     * 
     * @param array $pictures The list of pictures to be sorted.
     * 
     * @return array The pictures sorted by country.
     */
    private function _sortPictures(array $pictures): array
    {
        $picturesByCountry = [];

        foreach ($pictures as $v) {
            $country = preg_replace_callback('/\b\w|\b(?<=-)\w/u', function ($matches) {
                return mb_strtoupper($matches[0]);
            }, strtolower($v['data']['picture_data']['country']));

            if (!array_key_exists($country, $picturesByCountry)) {
                $picturesByCountry[$country] = [];
            }

            array_push($picturesByCountry[$country], $v);
        }

        return $picturesByCountry;
    }

    /**
     * Retrieves an admin by their API key.
     * 
     * @param array $adminsFile List of all admins.
     * 
     * @return array|null The admin data, or null if not found.
     */
    private function getAdminByKey($adminsFile): array|null
    {
        foreach ($adminsFile as $value) {
            if ($value['api_key'] === $this->adminInfo['apiKey']) {
                return $value;
            }
        }

        return null;
    }
}
