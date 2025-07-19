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

/* ./components/settings/picture_slideshow_component.twig */
class __TwigTemplate_5475add1145fb7b62363ffe314cc08cf extends Template
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
        yield "<div class=\"picture-element relative w-32 h-40 p-2 ";
        yield ((CoreExtension::inFilter(($context["picture"] ?? null), (($_v0 = ($context["selectedPictures"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0["paths"] ?? null) : null))) ? ("selected-picture-slideshow") : (""));
        yield " hover:cursor-pointer hover:selected-picture-slideshow group\" onclick=\"selectImageForSlideshow(event);\">

    ";
        // line 3
        if ((($tmp =  !(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["selectedPictures"] ?? null), "is_public", [], "array", false, true, false, 3), ($context["picture"] ?? null), [], "array", true, true, false, 3) &&  !(null === (($_v1 = (($_v2 = ($context["selectedPictures"] ?? null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2["is_public"] ?? null) : null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1[($context["picture"] ?? null)] ?? null) : null)))) ? ((($_v3 = (($_v4 = ($context["selectedPictures"] ?? null)) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4["is_public"] ?? null) : null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3[($context["picture"] ?? null)] ?? null) : null)) : (false))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 4
            yield "    <button type=\"button\" class=\"absolute top-2 right-2 bg-gray-200 p-2\" onclick=\"deleteUserPicture(event, '";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["picture"] ?? null), "html", null, true);
            yield "');\">
        <i class=\"fa-solid fa-trash text-red-800 hover:text-lg transition-all\"></i>
    </button>
    ";
        }
        // line 8
        yield "
    <img class=\"w-full h-28 object-cover\" src=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["picture"] ?? null), "html", null, true);
        yield "\" alt=\"\" data-picture-path=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["picture"] ?? null), "html", null, true);
        yield "\" loading=\"lazy\" />

    <p class=\"text-center group-hover:underline group-hover:font-semibold whitespace-nowrap overflow-x-auto\">
        ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::last($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), ($context["picture"] ?? null), "/")), "html", null, true);
        yield "
    </p>

</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "./components/settings/picture_slideshow_component.twig";
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
        return array (  69 => 12,  61 => 9,  58 => 8,  50 => 4,  48 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"picture-element relative w-32 h-40 p-2 {{ picture in selectedPictures['paths'] ? 'selected-picture-slideshow' : '' }} hover:cursor-pointer hover:selected-picture-slideshow group\" onclick=\"selectImageForSlideshow(event);\">

    {% if not (selectedPictures['is_public'][picture] ?? false) %}
    <button type=\"button\" class=\"absolute top-2 right-2 bg-gray-200 p-2\" onclick=\"deleteUserPicture(event, '{{ picture }}');\">
        <i class=\"fa-solid fa-trash text-red-800 hover:text-lg transition-all\"></i>
    </button>
    {% endif %}

    <img class=\"w-full h-28 object-cover\" src=\"{{ picture }}\" alt=\"\" data-picture-path=\"{{ picture }}\" loading=\"lazy\" />

    <p class=\"text-center group-hover:underline group-hover:font-semibold whitespace-nowrap overflow-x-auto\">
        {{ picture|split('/')|last }}
    </p>

</div>", "./components/settings/picture_slideshow_component.twig", "/var/www/zafkiel/src/Presentation/Templates/components/settings/picture_slideshow_component.twig");
    }
}
