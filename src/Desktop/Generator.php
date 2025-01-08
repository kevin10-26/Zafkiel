<?php declare(strict_types=1);

namespace Zafkiel\Desktop;

use Zafkiel\Core\Factory;
use Zafkiel\Rules\RulesManager;

use Zafkiel\Desktop\TwigRenderer;

class Generator extends TwigRenderer
{
    final const TEMPLATE_DESKTOP_FILE = 'zafkiel_desktop_template.html';
    final const TEMPLATE_MODULE_FILE  = 'zafkiel_module_template.html';

    public array $modules = [];
    public array $rules   = [];

    public function __construct(
        Factory $modules,
        RulesManager $rules
    )
    {  
        $this->modules = $modules;
        $this->rules   = $rules;
    }

    public function generate()
    {
        $this->render(self::TEMPLATE_DESKTOP_FILE, $this->_retrieveData());
    }

    private function _retrieveData()
    {
        return array(
            'modules' => $this->modules,
            'rules' => $this->rules
        );
    }
}