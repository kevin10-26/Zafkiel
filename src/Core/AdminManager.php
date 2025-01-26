<?php declare(strict_types=1);

namespace Zafkiel\Core;

use Zafkiel\Desktop\Background;

class AdminManager
{
    protected array $_userConf;

    protected function getAdminFile() : array
    {
        return json_decode(file_get_contents($this->_userConf['paths']['src'] . 'config/zafkiel_admin.json'), true);
    }

    protected function getAdmin($adminName) : array
    {
        $admin = $this->getAdminFile()[$adminName];
        $admin['additionnal_data']['preferences']['backgroundPictures'] = $this->_getPreferences($admin);

        return $admin;
    }

    protected function getAdminByKey($apiKey) : array|null
    {
        $adminsFile = $this->getAdminFile();
        
        foreach ($adminsFile as $key => $value)
        {
            if ($adminsFile[$key]['api_key'] === $apiKey) return $value;
        }

        return null;
    }

    protected function _getPreferences($admin) : array
    {
        $adminPreferences = $admin['additionnal_data']['preferences'];
        $background = new Background(__DIR__ . '/../Templates/img/backgrounds/', $adminPreferences['backgroundPictures']);

        if ($adminPreferences['background'] === 'userPicture')
        {
            return $adminPreferences['backgroundPictures'];
        } else
        {
            return $background->getBackground()->getPicturesData();
        }
    }
}