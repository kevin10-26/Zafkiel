<?php declare(strict_types=1);

namespace Zafkiel\Desktop;

use Twig\Environment;

class TwigRenderer implements Renderer
{
    private Environment $_renderer;
    private string $_source;
    private string $_templatesLocation;

    public function __construct(string $templatesLocation)
    {
        $this->_templatesLocation = $templatesLocation;
	    $this->_renderer          = $this->instantiate();
    }
    
    public function render($template, $data = []) : string
    {        
        return $this->_renderer->render("$template", $data);
    }

    private function instantiate()
    {
        $loader = new \Twig\Loader\FilesystemLoader($this->_templatesLocation);
        $twig = new \Twig\Environment($loader);

        return $twig;
    }
}