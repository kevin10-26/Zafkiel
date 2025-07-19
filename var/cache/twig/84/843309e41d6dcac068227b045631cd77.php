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

/* ./components/profile/control_button.twig */
class __TwigTemplate_88ed6e0299c7b241272d88cef9ed5a7f extends Template
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
        yield "<div class=\"flex sm:flex-row flex-col justify-end items-end w-full place-self-center my-4 gap-4\" style=\"grid-column: 1/3;\">
    <button type=\"button\" id=\"submit-profile-changes\" class=\"w-fit px-4 py-2 border-2 border-solid border-blue-400 bg-blue-400 text-stone-800 rounded-md hover:cursor-pointer hover:bg-transparent hover:text-white\" onclick=\"discardProfileChanges();\"><i class=\"fa-solid fa-spinner\"></i>&nbsp;&nbsp;Cancel changes</button>

    <button type=\"button\" id=\"submit-profile-changes\" class=\"w-fit px-4 py-2 border-2 border-solid border-gray-400 bg-gray-400 text-stone-800 rounded-md hover:cursor-pointer hover:bg-transparent hover:text-white\" onclick=\"saveAllProfileChanges();\"><i class=\"fa-solid fa-floppy-disk\"></i>&nbsp;&nbsp;Save all changes</button>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "./components/profile/control_button.twig";
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
        return new Source("<div class=\"flex sm:flex-row flex-col justify-end items-end w-full place-self-center my-4 gap-4\" style=\"grid-column: 1/3;\">
    <button type=\"button\" id=\"submit-profile-changes\" class=\"w-fit px-4 py-2 border-2 border-solid border-blue-400 bg-blue-400 text-stone-800 rounded-md hover:cursor-pointer hover:bg-transparent hover:text-white\" onclick=\"discardProfileChanges();\"><i class=\"fa-solid fa-spinner\"></i>&nbsp;&nbsp;Cancel changes</button>

    <button type=\"button\" id=\"submit-profile-changes\" class=\"w-fit px-4 py-2 border-2 border-solid border-gray-400 bg-gray-400 text-stone-800 rounded-md hover:cursor-pointer hover:bg-transparent hover:text-white\" onclick=\"saveAllProfileChanges();\"><i class=\"fa-solid fa-floppy-disk\"></i>&nbsp;&nbsp;Save all changes</button>
</div>", "./components/profile/control_button.twig", "/var/www/zafkiel/src/Presentation/Templates/components/profile/control_button.twig");
    }
}
