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
     * @param string $userConf The user configuration.
     * @param array $adminData The admin's data.
     * 
     * @return string Rendered slideshow preferences template.
     */
    public function getDataForAdminSlideshow(
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
    public function getDataForUserPictures(
        array $adminData,
        string $frontendRoutes,
        array $pictures
    ): string {
        $background = new Background('');

        $adminData['user_pictures'] = $background->getUserPictures($frontendRoutes, $adminData['name']);

        // Determine new pictures by comparing with existing ones
        $newPictures = array_diff(
            array_column($adminData['user_pictures'], 'path'),
            $pictures
        );

        // Filter and map the new pictures
        $adminData['user_pictures'] = array_filter(array_map(function ($item) {
            return (!is_null($item)) ? [
                'path'     => $item,
                'filename' => basename($item)
            ] : '';
        }, $newPictures));

        return $this->renderAdminData($adminData, 'settings/admin_user_pictures.html');
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
