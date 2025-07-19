<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* ./components/settings/pictures_options.twig */
class __TwigTemplate_35fbd05e4e31ad17f9d2679a958cbf57 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<div class=\"my-4\">
    <div class=\"flex flex-row justify-end items-center gap-x-4 w-full\">
        <button onclick=\"unselectAllPictures()\" class=\"px-4 py-2 bg-transparent rounded-md border-2 border-solid border-red-700 hover:bg-red-700 hover:text-gray-200 hover:cursor-pointer transition-all\">
            Unselect all
        </button>

        <button onclick=\"selectAllPictures()\" class=\"px-4 py-2 bg-transparent rounded-md border-2 border-solid border-blue-700 hover:bg-blue-700 hover:text-white hover:cursor-pointer transition-all\">
            Select all
        </button>

        <button onclick=\"submitSlideshowPictures()\" class=\"px-4 py-2 bg-gray-400 rounded-md border-2 border-solid border-transparent hover:border-gray-400 hover:bg-transparent hover:cursor-pointer transition-all\">
            Submit
        </button>
    </div>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "./components/settings/pictures_options.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"my-4\">
    <div class=\"flex flex-row justify-end items-center gap-x-4 w-full\">
        <button onclick=\"unselectAllPictures()\" class=\"px-4 py-2 bg-transparent rounded-md border-2 border-solid border-red-700 hover:bg-red-700 hover:text-gray-200 hover:cursor-pointer transition-all\">
            Unselect all
        </button>

        <button onclick=\"selectAllPictures()\" class=\"px-4 py-2 bg-transparent rounded-md border-2 border-solid border-blue-700 hover:bg-blue-700 hover:text-white hover:cursor-pointer transition-all\">
            Select all
        </button>

        <button onclick=\"submitSlideshowPictures()\" class=\"px-4 py-2 bg-gray-400 rounded-md border-2 border-solid border-transparent hover:border-gray-400 hover:bg-transparent hover:cursor-pointer transition-all\">
            Submit
        </button>
    </div>
</div>", "./components/settings/pictures_options.twig", "C:\\wamp64\\www\\zafkiel\\src\\Presentation\\Templates\\components\\settings\\pictures_options.twig");
    }
}
