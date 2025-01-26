<?php declare(strict_types=1);

namespace Zafkiel\Core;

use Zafkiel\Rules\RulesManager;

require(__DIR__ . '/BackofficeFactory.php');

use Zafkiel\Core\BackofficeFactory;
use Zafkiel\Desktop\TwigRenderer;

class Factory implements BackofficeFactory
{
    public RulesManager $rulesManager;

    public array $cData;
    public ?string $templatesLocation;

    public array $content;

    public function __construct(
        array $data,
        string $templatesLocation = "",
    )
    {
        $this->cData              = $data;
        $this->templatesLocation  = $templatesLocation;
    }

    public function importHTML(string $source) : Factory
    {
        $this->content = $this->execSourceTemplate($source);

        return $this;
    }

    public function getContent() : array
    {
        return $this->content;
    }

    public function pushBlock(string $node) : array
    {
        $rulesManager = new RulesManager(new \Zafkiel\Rules\DOMGenerator($node));

        return $rulesManager->addRule($node)->getLastInsertedRule();
    }

    private function execSourceTemplate() : array
    {
        $twigEnv = new TwigRenderer($this->templatesLocation);
        $templates = [];

        foreach(glob($this->templatesLocation . '*.html') as $template)
        {
            $module = strstr(basename($template), '.', true);
            
            $templates[$module] = $twigEnv->render(basename($template), $this->cData['items'][$module]['data']);
        }

        return $templates;
    }
}