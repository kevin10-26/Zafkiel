<?php declare(strict_types=1);

namespace Zafkiel\Desktop;

use Zafkiel\Core\Factory;
use Zafkiel\Core\AdminManager;

use Zafkiel\Desktop\Background;
use Zafkiel\Desktop\TwigRenderer;

class Generator extends AdminManager
{
    final const TEMPLATE_DESKTOP_FILE = 'zafkiel_desktop_template.html';
    final const TEMPLATE_MODULE_FILE  = 'zafkiel_module_template.html';

    final const SESSION_STATUS_COLOR  = array(
        'Online'       => '#176739',
        'Disconnected' => '#952123'
    );

    public array $modules      = [];
    public ?array $rules       = [];
    public array $currentAdmin = [];
    
    public Factory $template;

    private string $_session;

    public function __construct(
        array $modules,
        string $baseDir,
        Factory $template,
        string $session
    )
    {  
        $this->modules       = $modules;
        $this->template      = $template;
        $this->_session      = $session;

        // Needs to check whether thenuser added a slash at the end of the dir
        // To avoid issues while opening the config file.
        $this->_baseDir      = (substr($baseDir, 0, -1) !== '/') ? $baseDir . '/' : $baseDir;
    }

    public function generate() : string
    {
        $renderer = new TwigRenderer(__DIR__ . '/../Templates/html/');

        return $renderer->render(self::TEMPLATE_DESKTOP_FILE, $this->_retrieveData());
    }

    private function getAdminData() : array
    {
        $data['admins'] = $this->getAdminFile();
        
        foreach($data['admins'] as $key => $value)
        {
            $data['admins'][$key]['session']['color'] = self::SESSION_STATUS_COLOR[$value['session']['status']];
        }

        $data['currentAdmin'] = $this->getAdmin($this->_session);

        $this->currentAdmin = $data['currentAdmin'];

        return $data;
    }

    private function _retrieveData() : array
    {
        return array(
            'modules'      => $this->modules,
            'templates'    => $this->template->getContent(),
            'adminData'    => $this->getAdminData(),
            'preferences'  => $this->_getPreferences(),
            'baseDir'      => $this->_baseDir
        );
    }

    private function _getPreferences() : array
    {
        $adminPreferences = $this->currentAdmin['additionnal_data']['preferences'];
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