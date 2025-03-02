<?php

declare(strict_types=1);

/**
 * Zafkiel Desktop Generator
 *
 * This file is part of the Zafkiel project.
 *
 * Licensed under the GNU Lesser General Public License v2.1 (LGPL-2.1).
 * You may obtain a copy of the License at:
 * http://www.gnu.org/licenses/lgpl-2.1.html
 * 
 * @package Zafkiel\Desktop
 */

namespace Zafkiel\Desktop;

use Zafkiel\Core\Factory;
use Zafkiel\Core\AdminManager;
use Zafkiel\Desktop\TwigRenderer;

/**
 * Class Generator
 *
 * The Generator class is responsible for generating the desktop template with dynamic data
 * and rendering it using Twig. It retrieves the necessary data about the admin and modules
 * to populate the templates.
 *
 * @package Zafkiel\Desktop
 */
class Generator extends AdminManager
{
    // Constants
    final const TEMPLATE_DESKTOP_FILE = 'zafkiel_desktop_template.html';
    final const TEMPLATE_MODULE_FILE  = 'zafkiel_module_template.html';
    final const SESSION_STATUS_COLOR  = [
        'Online'       => '#176739',
        'Disconnected' => '#952123',
    ];

    // Properties
    public ?array $rules = [];
    public array $currentAdmin = [];
    public Factory $template;
    private string $_session;

    /**
     * Constructor for the Generator class.
     *
     * @param array $_routesConfig The routing configuration.
     * @param Factory $template The factory for handling template contents.
     * @param string $session The current admin session.
     */
    public function __construct(array $_routesConfig, Factory $template, string $session)
    {
        $this->_routesConfig = $_routesConfig;
        $this->template = $template;
        $this->_session = $session;
    }

    /**
     * Generates the desktop template with the provided modules.
     *
     * @param array $modules An array of modules to include in the desktop template.
     * @return string The rendered HTML template.
     */
    public function generate(array $modules): string
    {
        $renderer = new TwigRenderer(__DIR__ . '/../Templates/html/');
        return $renderer->render(self::TEMPLATE_DESKTOP_FILE, $this->_retrieveData($modules));
    }

    /**
     * Retrieves admin-related data, including the admin's session color.
     *
     * @return array An array containing the admins' data and the current admin.
     */
    private function getAdminData(): array
    {
        $data['admins'] = $this->getAdminFile();

        // Set the session color based on the admin's session status.
        foreach ($data['admins'] as $key => $value) {
            $data['admins'][$key]['session']['color'] = self::SESSION_STATUS_COLOR[$value['session']['status']];
        }

        $data['currentAdmin'] = $this->getAdmin($this->_session);

        return $data;
    }

    /**
     * Retrieves the components required for the desktop, including modules and templates.
     *
     * @param array $modules The modules to be displayed.
     * @return array An array containing modules and templates content.
     */
    private function _getComponents(array $modules): array
    {
        return [
            'modules'   => $modules,
            'templates' => $this->template->getContent(),
        ];
    }

    /**
     * Retrieves all the necessary data to render the desktop template.
     *
     * @param array $modules The modules to be included in the template.
     * @return array An array containing the pictures path, components, and admin data.
     */
    private function _retrieveData(array $modules): array
    {
        return [
            'picturesPath' => $this->_routesConfig['frontend_components'],
            'components'   => $this->_getComponents($modules),
            'adminData'    => $this->getAdminData(),
        ];
    }
}
