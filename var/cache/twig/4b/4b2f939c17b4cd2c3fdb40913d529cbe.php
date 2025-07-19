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

/* components/monitoring/AdminViewer.twig */
class __TwigTemplate_5926b44fde5528a84a071c7f62927b63 extends Template
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
        yield "<div id=\"admin-information\" class=\"admin-monitoring-tab-content text-stone-800 my-10\">
    <div class=\"grid grid-cols-2 gap-4\">
        <div class=\"flex flex-row gap-4 items-center col-span-2 mb-4\">
            <img class=\"w-24 h-24 rounded-full\" src=\"";
        // line 4
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "personalData", [], "any", false, false, false, 4), "profilePicture", [], "any", false, false, false, 4), "html", null, true);
        yield "\" alt=\"Admin Avatar\" />

            <p class=\"text-lg font-semibold\">";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "name", [], "any", false, false, false, 6), "html", null, true);
        yield "</p>
        </div>
        
        <div class=\"p-2 row-start-2 gap-4\">
            <div class=\"flex flex-row justify-start items-center\">
                <div class=\"w-4 h-4 rounded-full mr-2\" style=\"background-color: ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "sessionStatus", [], "any", false, false, false, 11), "color", [], "any", false, false, false, 11), "html", null, true);
        yield ";\"></div>
                <p>
                    ";
        // line 13
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "sessionStatus", [], "any", false, false, false, 13), "status", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Online") : ("Offline"));
        yield "
                </p>
            </div>
        </div>

        <div class=\"row-start-3\">
            <p class=\"text-lg text-stone-800\"><span class=\"underline\">E-mail address:</span> ";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "emailAddr", [], "any", false, false, false, 19), "html", null, true);
        yield "</p>
        </div>
        
        <div class=\"row-start-3\">
            <p class=\"text-lg text-stone-800\"><span class=\"underline\">Status:</span> ";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["admin"] ?? null), "status", [], "any", false, false, false, 23), "html", null, true);
        yield "</p>
        </div>
    </div>
</div>

<div id=\"danger-zone\" class=\"admin-monitoring-tab-content w-full p-4 h-full overflow-auto hidden\"></div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/monitoring/AdminViewer.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  81 => 23,  74 => 19,  65 => 13,  60 => 11,  52 => 6,  47 => 4,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div id=\"admin-information\" class=\"admin-monitoring-tab-content text-stone-800 my-10\">
    <div class=\"grid grid-cols-2 gap-4\">
        <div class=\"flex flex-row gap-4 items-center col-span-2 mb-4\">
            <img class=\"w-24 h-24 rounded-full\" src=\"{{ admin.personalData.profilePicture }}\" alt=\"Admin Avatar\" />

            <p class=\"text-lg font-semibold\">{{ admin.name }}</p>
        </div>
        
        <div class=\"p-2 row-start-2 gap-4\">
            <div class=\"flex flex-row justify-start items-center\">
                <div class=\"w-4 h-4 rounded-full mr-2\" style=\"background-color: {{ admin.sessionStatus.color }};\"></div>
                <p>
                    {{ admin.sessionStatus.status ? 'Online' : 'Offline' }}
                </p>
            </div>
        </div>

        <div class=\"row-start-3\">
            <p class=\"text-lg text-stone-800\"><span class=\"underline\">E-mail address:</span> {{ admin.emailAddr }}</p>
        </div>
        
        <div class=\"row-start-3\">
            <p class=\"text-lg text-stone-800\"><span class=\"underline\">Status:</span> {{ admin.status }}</p>
        </div>
    </div>
</div>

<div id=\"danger-zone\" class=\"admin-monitoring-tab-content w-full p-4 h-full overflow-auto hidden\"></div>
", "components/monitoring/AdminViewer.twig", "/var/www/zafkiel/src/Presentation/Templates/components/monitoring/AdminViewer.twig");
    }
}
