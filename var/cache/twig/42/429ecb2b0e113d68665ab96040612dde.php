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
class __TwigTemplate_19615cd02773c04a88e26dac4474a991 extends Template
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
        yield ((CoreExtension::inFilter(Twig\Extension\CoreExtension::last($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["picture"] ?? null), "picturePath", [], "any", false, false, false, 1), "/")), ($context["allUserPictures"] ?? null))) ? ("selected-picture-slideshow") : (""));
        yield " hover:cursor-pointer hover:selected-picture-slideshow group\" onclick=\"selectImageForSlideshow(event);\">

    ";
        // line 3
        if ((CoreExtension::getAttribute($this->env, $this->source, ($context["picture"] ?? null), "isPublic", [], "any", false, false, false, 3) == false)) {
            // line 4
            yield "    <button type=\"button\" class=\"absolute top-2 right-2 bg-gray-200 p-2\" onclick=\"deleteUserPicture(event, '";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["picture"] ?? null), "picturePath", [], "any", false, false, false, 4), "html", null, true);
            yield "');\">
        <i class=\"fa-solid fa-trash text-red-800 hover:text-lg transition-all\"></i>
    </button>
    ";
        }
        // line 8
        yield "
    <img class=\"w-full h-28 object-cover\" src=\"";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["picture"] ?? null), "picturePath", [], "any", false, false, false, 9), "html", null, true);
        yield "\" alt=\"\" data-picture-path=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["picture"] ?? null), "picturePath", [], "any", false, false, false, 9), "html", null, true);
        yield "\" loading=\"lazy\" />

    <p class=\"text-center group-hover:underline group-hover:font-semibold whitespace-nowrap overflow-x-auto\">
        ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["picture"] ?? null), "name", [], "any", false, false, false, 12), "html", null, true);
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
        return new Source("<div class=\"picture-element relative w-32 h-40 p-2 {{ (picture.picturePath|split('/')|last in allUserPictures) ? 'selected-picture-slideshow' : '' }} hover:cursor-pointer hover:selected-picture-slideshow group\" onclick=\"selectImageForSlideshow(event);\">

    {% if picture.isPublic == false %}
    <button type=\"button\" class=\"absolute top-2 right-2 bg-gray-200 p-2\" onclick=\"deleteUserPicture(event, '{{ picture.picturePath }}');\">
        <i class=\"fa-solid fa-trash text-red-800 hover:text-lg transition-all\"></i>
    </button>
    {% endif %}

    <img class=\"w-full h-28 object-cover\" src=\"{{ picture.picturePath }}\" alt=\"\" data-picture-path=\"{{ picture.picturePath }}\" loading=\"lazy\" />

    <p class=\"text-center group-hover:underline group-hover:font-semibold whitespace-nowrap overflow-x-auto\">
        {{ picture.name }}
    </p>

</div>", "./components/settings/picture_slideshow_component.twig", "C:\\wamp64\\www\\zafkiel\\src\\Presentation\\Templates\\components\\settings\\picture_slideshow_component.twig");
    }
}
