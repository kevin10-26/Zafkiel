<?php

declare(strict_types=1);

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

    public ?array $rules        = [];
    public array $currentAdmin  = [];

    public Factory $template;

    private string $_session;

    public function __construct(
        array $_routesConfig,
        Factory $template,
        string $session
    ) {
        $this->_routesConfig   = $_routesConfig;
        $this->template        = $template;
        $this->_session        = $session;
    }

    public function generate(array $modules): string
    {
        $renderer = new TwigRenderer(__DIR__ . '/../Templates/html/');

        return $renderer->render(self::TEMPLATE_DESKTOP_FILE, $this->_retrieveData($modules));
    }

    private function getAdminData(): array
    {
        $data['admins'] = $this->getAdminFile();

        foreach ($data['admins'] as $key => $value) {
            $data['admins'][$key]['session']['color'] = self::SESSION_STATUS_COLOR[$value['session']['status']];
        }

        $data['currentAdmin'] = $this->getAdmin($this->_session);

        return $data;
    }

    private function _getComponents(array $modules)
    {
        return array(
            'modules'         => $modules,
            'templates'       => $this->template->getContent()
        );
    }

    private function _retrieveData(array $modules): array
    {
        return array(
            'picturesPath' => $this->_routesConfig['frontend_components'],
            'components'   => $this->_getComponents($modules),
            'adminData'    => $this->getAdminData()
        );
    }
}
