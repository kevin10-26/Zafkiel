<?php declare(strict_types=1);

namespace Zafkiel\API;

use Zafkiel\Desktop\Background;
use Zafkiel\Desktop\TwigRenderer;

class AdminFetchInterfaceAPI
{
    public array $adminInfo;

    public function __construct(array $adminInfo)
    {
        $this->adminInfo          = $adminInfo;
    }

    public function getDataForAdminStatus(
        array $adminsFile,
        string $targetedAdmin
    ) : string
    {
        $adminData = array(
            "name"                => $adminsFile[$targetedAdmin]['name'],
            "status"              => $adminsFile[$targetedAdmin]['status'],
            "currentAdminSession" => $this->getAdminByKey($adminsFile)
        );

        return $this->renderAdminData($adminData, 'settings/adminsMonitoring.html');
    }

    public function getDataForAdminSlideshow(array $adminData) : string
    {
        $background = new Background(__DIR__ . '/../Templates/img/backgrounds', []);

        $adminData['slideshow_pictures'] = $background->getAllPictures()->getPicturesData();

        $adminData['slideshow_pictures'] = $this->_sortPictures($adminData['slideshow_pictures']);

        return $this->renderAdminData($adminData, 'settings/admin_slideshow_preferences.html');
    }

    public function getDataForUserPictures($picturesLocation, $adminData, $adminsPictures) : string
    {
        $background = new Background($picturesLocation);

        $adminData['user_pictures'] = $background->getUserPictures($adminsPictures);

        return $this->renderAdminData($adminData, 'settings/admin_user_pictures.html');
    }

    private function renderAdminData(
        array $data,
        string $filename
    )
    {
        $renderer = new TwigRenderer(__DIR__ . '/../Templates/');

        return $renderer->render('html/components/' . $filename, $data);
    }

    private function _sortPictures(array $pictures) : array
    {
        $picturesByCountry = [];

        foreach ($pictures as $v)
        {
            $country = preg_replace_callback('/\b\w|\b(?<=-)\w/u', function ($matches) {

                return mb_strtoupper($matches[0]);

            }, strtolower($v['data']['picture_data']['country']));

            if (!array_key_exists($country, $picturesByCountry))
            {
                
                $picturesByCountry[$country] = [];

            }

            array_push($picturesByCountry[$country], $v);
        }

        return $picturesByCountry;
    }

    private function getAdminByKey($adminsFile) : array|null
    {
        // Get API Key to check user
        foreach ($adminsFile as $value)
        {
            if ($value['api_key'] === $this->adminInfo['apiKey']) {
                return $value;
            }
            
        }

        return null;
    }
}