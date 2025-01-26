<?php declare(strict_types=1);

namespace Zafkiel\Core;

class AdminManager
{
    protected string $_baseDir;

    protected function getAdminFile() : array
    {
        return json_decode(file_get_contents($this->_baseDir . 'config/zafkiel_admin.json'), true);
    }

    protected function getAdmin($adminName) : array
    {
        return $this->getAdminFile($this->_baseDir)[$adminName];
    }

    protected function getAdminByKey($apiKey) : array|null
    {
        $adminsFile = $this->getAdminFile($this->_baseDir);
        
        foreach ($adminsFile as $key => $value)
        {
            if ($adminsFile[$key]['api_key'] === $apiKey) return $value;
        }

        return null;
    }
}