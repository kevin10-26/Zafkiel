<?php

declare(strict_types=1);

/**
 * Zafkiel Admin Manager
 *
 * This file is part of the Zafkiel project.
 *
 * Licensed under the GNU Lesser General Public License v2.1 (LGPL-2.1).
 * You may obtain a copy of the License at:
 * http://www.gnu.org/licenses/lgpl-2.1.html
 * 
 * @package Zafkiel\Core
 */

namespace Zafkiel\Core;

use Zafkiel\Desktop\Background;

/**
 * Class AdminManager
 *
 * The AdminManager class is responsible for managing and retrieving admin-related data,
 * such as admin configurations, preferences, and background pictures.
 *
 * @package Zafkiel\Core
 */
class AdminManager
{
    // Properties
    protected array $_routesConfig;

    /**
     * Retrieves the admin configuration file.
     *
     * @return array The parsed admin configuration as an associative array.
     */
    protected function getAdminFile(): array
    {
        $filePath = $this->_routesConfig['src'] . 'config/zafkiel_admin.json';
        return json_decode(file_get_contents($filePath), true);
    }

    /**
     * Retrieves the data of a specific admin by their name.
     *
     * @param string $adminName The name of the admin to retrieve.
     * @return array The admin data, including preferences and background pictures.
     */
    protected function getAdmin(string $adminName): array
    {
        $admin = $this->getAdminFile()[$adminName];

        // Add background picture preferences to the admin data
        $admin['additionnal_data']['preferences']['backgroundPictures'] = $this->_getPreferences($admin);

        return $admin;
    }

    /**
     * Retrieves the admin data based on the provided API key.
     *
     * @param string $apiKey The API key to search for.
     * @return array|null The admin data if found, or null if no admin matches the API key.
     */
    protected function getAdminByKey(string $apiKey): ?array
    {
        $adminsFile = $this->getAdminFile();

        // Iterate over the admins to find a matching API key
        foreach ($adminsFile as $key => $value) {
            if ($adminsFile[$key]['api_key'] === $apiKey) {
                return $value;
            }
        }

        // Return null if no matching admin is found
        return null;
    }

    /**
     * Retrieves the preferences for the given admin, including their background pictures.
     *
     * @param array $admin The admin data.
     * @return array An array of background picture data.
     */
    protected function _getPreferences(array $admin): array
    {
        $adminPreferences = $admin['additionnal_data']['preferences'];
        $background = new Background($this->_routesConfig['frontend_components'], $adminPreferences['backgroundPictures']);

        // Get the background picture data from the Background class
        return $background->getPicturesData($adminPreferences['backgroundPictures']);
    }
}
