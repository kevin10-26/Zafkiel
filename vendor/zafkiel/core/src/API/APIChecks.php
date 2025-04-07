<?php

declare(strict_types=1);

namespace Zafkiel\API;

use Zafkiel\Core\AdminManager;

/**
 * APIChecks handles the verification of API keys for authentication purposes.
 * 
 * This class provides functionality for verifying API keys against a list of valid keys
 * stored in the admin data file. It throws an exception if the provided key is invalid.
 *
 * @license LGPL-2.1
 */
class APIChecks extends AdminManager
{
    /**
     * APIChecks constructor.
     * 
     * @param array $routesConfig The routing configuration for the application.
     */
    public function __construct(array $routesConfig)
    {
        $this->_routesConfig = $routesConfig;
    }

    /**
     * Verifies whether the provided API key is valid.
     * 
     * @param string $key The API key to be verified.
     * 
     * @return bool Returns true if the key is valid, throws an exception otherwise.
     * 
     * @throws \Exception If the key is not recognized.
     */
    public function verify(string $key): bool
    {
        $keys = $this->getAPIKeys();

        if (in_array($key, $keys, true)) {
            return true;
        } else {
            throw new \Exception('The key you provided is not recognized');
        }
    }

    /**
     * Retrieves the list of API keys from the admin file.
     * 
     * @return array The array of API keys.
     */
    private function getAPIKeys(): array
    {
        $adminData = $this->getAdminFile();

        // Extracting API keys from the admin data
        return array_column($adminData, 'api_key');
    }
}
