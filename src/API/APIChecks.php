<?php declare(strict_types=1);

namespace Zafkiel\API;

use Zafkiel\Core\AdminManager;

class APIChecks extends AdminManager
{
    public function __construct(string $baseDir)
    {
        $this->_baseDir = $baseDir;
    }

    public function verify($key)
    {
        // return true;
        $keys = $this->getAPIKeys();

        if (in_array($key, $keys))
        {

            return true;

        } else
        {
            throw new \Exception('The key you provided is not recognized');
        }
    }

    private function getAPIKeys()
    {
        $adminData = $this->getAdminFile();
        /*$keys = [];

        foreach ($adminData as $key => $value)
        {
            $keys[] = $value['api_key'];
        }*/

        return array_column($adminData, 'api_key');
    }
}