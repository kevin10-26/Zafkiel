<?php declare(strict_types=1);

namespace Zafkiel\API;

use Zafkiel\Desktop\Background;
use Zafkiel\Desktop\TwigRenderer;

class AdminInterfaceAPI
{
    public array $adminInfo;
    private string $_templatesLocation;

    public function __construct(
        array $adminInfo,
        string $templatesLocation
    )
    {
        $this->adminInfo          = $adminInfo;
        $this->_templatesLocation = $templatesLocation;
    }

    public function getDataForAdminStatus(
        array $adminsFile,
        string $targetedAdmin
    )
    {
        $adminData = array(
            "name"                => $adminsFile[$targetedAdmin]['name'],
            "status"              => $adminsFile[$targetedAdmin]['status'],
            "currentAdminSession" => $this->getAdminByKey($adminsFile)
        );

        return $this->renderAdminData($adminData, 'adminsMonitoring.html');
    }

    public function getDataForAdminSlideshow(
        array $adminData
    ) : string
    {
        $background = new Background(__DIR__ . '/../Templates/img/backgrounds', []);

        $adminData['slideshow_pictures'] = $background->getAllPictures()->getPicturesData();
        
        $picturesByCountry = [];

        foreach ($adminData['slideshow_pictures'] as $v)
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

        $adminData['slideshow_pictures'] = $picturesByCountry;

        return $this->renderAdminData($adminData, 'admin_slideshow_preferences.html');
    }

    public function getDataForUserPictures($picturesLocation, $adminData, $adminsPictures) : string
    {
        $background = new Background($picturesLocation);

        $adminData['user_pictures'] = $background->getUserPictures($adminsPictures);

        return $this->renderAdminData($adminData, 'admin_user_pictures.html');
    }

    private function renderAdminData(
        array $data,
        string $filename
    )
    {
        $template = strrchr($this->_templatesLocation, '/');

        $renderer = new TwigRenderer($this->_templatesLocation);

        return $renderer->render('zafkiel/core/src/Templates/html/components/' . $filename, $data);
    }

    private function getAdminByKey($adminsFile) : array|null
    {
        // Get API Key to check user
        foreach ($adminsFile as $key => $value)
        {
            if ($value['api_key'] === $this->adminInfo['apiKey']) {
                return $value;
            }
            
        }

        return null;
    }
}