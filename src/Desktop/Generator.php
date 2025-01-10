<?php declare(strict_types=1);

namespace Zafkiel\Desktop;

use Zafkiel\Core\Factory;
use Zafkiel\Rules\RulesManager;

use Zafkiel\Desktop\TwigRenderer;

class Generator extends TwigRenderer
{
    final const TEMPLATE_DESKTOP_FILE = 'zafkiel_desktop_template.html';
    final const TEMPLATE_MODULE_FILE  = 'zafkiel_module_template.html';

    public array $modules    = [];
    public ?array $rules     = [];
    public ?string $template = '';

    public function __construct(
        array $modules,
        Factory $template
    )
    {  
        $this->modules    = $modules;
        $this->template   = $template;
    }

    public function generate()
    {
        $this->render(self::TEMPLATE_DESKTOP_FILE, $this->_retrieveData());
    }

    private function _retrieveData()
    {
        return array(
            'modules'  => $this->modules,
            'template' => $this->template
        );
    }
}