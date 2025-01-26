<?php declare(strict_types=1);

namespace Zafkiel\Desktop;

class Background
{
    private string $_base;

    private array|null $_pictures;

    public function __construct(
        string $base,
        array|null $pictures = []
    )
    {
        $this->_base = $base;
        $this->_pictures = $pictures;
    }

    public function getAllPictures() : Background
    {
        $this->_getPictures();

        return $this;
    }

    public function getUserPictures($pathToAdminsPictures) : array
    {
        $userPictures = [];
        $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? 'https://' : 'http://';

        foreach (glob($this->_base . '/*.jpg') as $pictureName)
        {
            $userPictures[] = $pathToAdminsPictures . basename($pictureName);
        }

        return $userPictures;
    }

    public function getBackground() : Background
    {
        $this->_getPictures()->_shufflePictures(5);

        return $this;
    }

    public function getPicturesData() : array
    {
        $picturesWithData = [];

        for ($i = 0; $i < count($this->_pictures); $i++)
        {
            $picturesWithData[$i] = array(
                'path'     => $this->_pictures[$i],
                'filename' => basename($this->_pictures[$i]),
                'data'     => json_decode(
                    file_get_contents(__DIR__ . '/../Templates/img/backgrounds/facts/data_' . 
                        strstr(
                            basename($this->_pictures[$i]), '.', true
                        ). '.json'
                    ), true
                )
            );
        }

        return $picturesWithData;
    }

    private function _getPictures() : Background
    {
        $pictures = [];
        $http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? 'https://' : 'http://';

        foreach (glob($this->_base . '/pictures/*.jpg') as $pictureName)
        {
            $pictures[] = $http . $_SERVER['SERVER_NAME'] . '/vendor/zafkiel/core/src/Templates/img/backgrounds/pictures/' . basename($pictureName);
        }
        
        $this->_pictures = $pictures;

        return $this;
    }

    private function _shufflePictures(int $maxPictures) : array
    {
        shuffle($this->_pictures);

        return array_slice($this->_pictures, 0, $maxPictures);
    }
}