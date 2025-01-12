<?php declare(strict_types=1);

namespace Zafkiel\Core;

use Zafkiel\Rules\RulesManager;

require(__DIR__ . '/BackofficeFactory.php');

use Zafkiel\Core\BackofficeFactory;
use Zafkiel\Desktop\TwigRenderer;

class Factory implements BackofficeFactory
{
    public RulesManager $rulesManager;

    public string $module;
    public array $cData;
    public ?string $templatesLocation;

    public string $_content;

    public function __construct(
        string $module,
        array $data,
        string $templatesLocation = "",
    )
    {
        $this->module             = $module;
        $this->cData              = $data;
        $this->templatesLocation = $templatesLocation;
    }

    public function importHTML(string $source) : Factory
    {
        $this->_content = $this->execSourceTemplate($source);

        return $this;
    }

    public function getContent() : string
    {
        return $this->_content;
    }

    public function pushBlock(string $node) : array
    {
        $rulesManager = new RulesManager(new \Zafkiel\Rules\DOMGenerator($node));

        return $rulesManager->addRule($node)->getLastInsertedRule();
    }

    private function execSourceTemplate($source) : string
    {
        $twigEnv = new TwigRenderer($this->templatesLocation);

        return $twigEnv->render($source, $this->cData);
    }
}