<?php

declare(strict_types=1);

namespace Zafkiel\Core;

use Zafkiel\Rules\RulesManager;
use Zafkiel\Desktop\TwigRenderer;

/**
 * Factory class for generating and managing backoffice content.
 * 
 * This class implements the BackofficeFactory interface and is responsible for
 * importing HTML templates, rendering content, and managing rule sets for blocks
 * of HTML. It leverages the Twig templating engine for rendering templates.
 *
 * @license LGPL-2.1
 */
class Factory implements BackofficeFactory
{
    /**
     * @var RulesManager The rules manager for managing HTML node rules.
     */
    public RulesManager $rulesManager;

    /**
     * @var array Contains configuration and data for the factory.
     */
    public array $cData;

    /**
     * @var string|null Path to the templates location.
     */
    public ?string $templatesLocation;

    /**
     * @var array Contains the rendered content.
     */
    public array $content;

    /**
     * Factory constructor.
     * 
     * @param array $data The data array for the factory.
     * @param string $templatesLocation The location of HTML templates.
     */
    public function __construct(
        array $data,
        string $templatesLocation = ""
    ) {
        $this->cData = $data;
        $this->templatesLocation = $templatesLocation;
    }

    /**
     * Imports HTML templates and renders them.
     * 
     * @param string $source The source template to import.
     * 
     * @return Factory The current Factory instance for chaining.
     */
    public function importHTML(string $source): Factory
    {
        $this->content = $this->execSourceTemplate($source);

        return $this;
    }

    /**
     * Gets the rendered content.
     * 
     * @return array The rendered content.
     */
    public function getContent(): array
    {
        return $this->content;
    }

    /**
     * Pushes a block node and generates rules for it.
     * 
     * @param string $node The HTML node to generate rules for.
     * 
     * @return array The last inserted rule after pushing.
     */
    public function pushBlock(string $node): array
    {
        $rulesManager = new RulesManager(new \Zafkiel\Rules\DOMGenerator($node));

        return $rulesManager->addRule($node)->getLastInsertedRule();
    }

    /**
     * Executes and renders HTML templates using Twig.
     * 
     * @return array The rendered templates for each module.
     */
    private function execSourceTemplate(): array
    {
        $twigEnv = new TwigRenderer($this->templatesLocation);
        $templates = [];

        foreach (glob($this->templatesLocation . '*.html') as $template) {
            $module = strstr(basename($template), '.', true);

            // Ensure module data exists before rendering
            if (isset($this->cData['items'][$module]['data'])) {
                $templates[$module] = $twigEnv->render(basename($template), $this->cData['items'][$module]['data']);
            }
        }

        return $templates;
    }
}
