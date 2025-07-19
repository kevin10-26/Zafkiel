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

/* components/settings/admin_slideshow_preferences.twig */
class __TwigTemplate_cb70c8e6d1e5c6ec892d355ab19f38a1 extends Template
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
        yield "<div class=\"pb-4\" id=\"toggle-pictures-slideshow\">

\t";
        // line 3
        yield from $this->load("./components/settings/pictures_options.twig", 3)->unwrap()->yield(CoreExtension::merge($context, ["name" => ($context["name"] ?? null), "api_key" => ($context["api_key"] ?? null)]));
        // line 4
        yield "
\t<div id=\"default-pictures\" class=\"slideshow-tab-content\">
\t\t<p class=\"font-semibold text-3xl\">Default pictures</p>

\t\t";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((($_v0 = ($context["pictures"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0["default"] ?? null) : null));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["picture"]) {
            // line 9
            yield "
\t\t\t<div class=\"w-full grid grid-cols-4 place-content-center gap-4\">

\t\t\t\t";
            // line 12
            yield from $this->load("./components/settings/picture_slideshow_component.twig", 12)->unwrap()->yield(CoreExtension::merge($context, ["picture" => $context["picture"]]));
            // line 13
            yield "\t\t\t</div>

\t\t";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 15
        if (!$context['_iterated']) {
            // line 16
            yield "
\t\t\t<p>There aren't any default pictures. If this doesn't seem normal, please contact your administrator.</p>

\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['picture'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        yield "\t</div>

\t<div id=\"user-pictures\" class=\"slideshow-tab-content hidden\">
\t\t<p class=\"font-semibold text-3xl mb-4\">
\t\t\tMy pictures
\t\t</p>
\t\t
\t\t";
        // line 27
        yield from $this->load("./components/settings/admin_user_pictures.twig", 27)->unwrap()->yield(CoreExtension::merge($context, ["privatePictures" => (($_v1 = ($context["pictures"] ?? null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1["private"] ?? null) : null)]));
        // line 28
        yield "\t</div>

\t";
        // line 30
        yield from $this->load("./components/settings/pictures_options.twig", 30)->unwrap()->yield($context);
        // line 31
        yield "</div>

<div id=\"upload-picture\" class=\"slideshow-tab-content hidden w-full\">
\t<p class=\"font-semibold text-3xl mb-4\">Upload a picture</p>

\t<form id=\"user-pictures-uploader\" class=\"w-full\" onsubmit=\"uploadSlideshowPicture(event);\">
\t\t<label for=\"upload-file-input\">
\t\t\t<p type=\"button\" class=\"block w-fit mx-auto p-4 bg-transparent border-gray-200 border-solid border-2 hover:bg-gray-200 hover:cursor-pointer\">
\t\t\t\tChoose a picture
\t\t\t</p>
\t\t</label>
\t\t<input type=\"file\" id=\"upload-file-input\" class=\"hidden\" onchange=\"showPicturePreview(event, 'preview-uploaded-file');\"/>

\t\t<div class=\"w-full\">
\t\t\t<p class=\"font-semibold text-xl my-4\">Picture preview</p>
\t\t\t<img id=\"preview-uploaded-file\" class=\"hidden w-full h-56 object-cover\" src=\"\" alt=\"\"/>
\t\t</div>

\t\t<input type=\"submit\" id=\"upload-picture-btn\" class=\"w-full p-4 bg-transparent border-gray-400 border-solid border-2 hover:bg-gray-400 hover:cursor-pointer transition-all\" value=\"Choose this picture\"/>
\t</form>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/settings/admin_slideshow_preferences.twig";
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
        return array (  121 => 31,  119 => 30,  115 => 28,  113 => 27,  104 => 20,  95 => 16,  93 => 15,  79 => 13,  77 => 12,  72 => 9,  54 => 8,  48 => 4,  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"pb-4\" id=\"toggle-pictures-slideshow\">

\t{% include './components/settings/pictures_options.twig' with {'name': name, 'api_key': api_key} %}

\t<div id=\"default-pictures\" class=\"slideshow-tab-content\">
\t\t<p class=\"font-semibold text-3xl\">Default pictures</p>

\t\t{% for picture in pictures['default'] %}

\t\t\t<div class=\"w-full grid grid-cols-4 place-content-center gap-4\">

\t\t\t\t{% include \"./components/settings/picture_slideshow_component.twig\" with {picture: picture} %}
\t\t\t</div>

\t\t{% else %}

\t\t\t<p>There aren't any default pictures. If this doesn't seem normal, please contact your administrator.</p>

\t\t{% endfor %}
\t</div>

\t<div id=\"user-pictures\" class=\"slideshow-tab-content hidden\">
\t\t<p class=\"font-semibold text-3xl mb-4\">
\t\t\tMy pictures
\t\t</p>
\t\t
\t\t{% include \"./components/settings/admin_user_pictures.twig\" with {privatePictures: pictures['private']} %}
\t</div>

\t{% include './components/settings/pictures_options.twig' %}
</div>

<div id=\"upload-picture\" class=\"slideshow-tab-content hidden w-full\">
\t<p class=\"font-semibold text-3xl mb-4\">Upload a picture</p>

\t<form id=\"user-pictures-uploader\" class=\"w-full\" onsubmit=\"uploadSlideshowPicture(event);\">
\t\t<label for=\"upload-file-input\">
\t\t\t<p type=\"button\" class=\"block w-fit mx-auto p-4 bg-transparent border-gray-200 border-solid border-2 hover:bg-gray-200 hover:cursor-pointer\">
\t\t\t\tChoose a picture
\t\t\t</p>
\t\t</label>
\t\t<input type=\"file\" id=\"upload-file-input\" class=\"hidden\" onchange=\"showPicturePreview(event, 'preview-uploaded-file');\"/>

\t\t<div class=\"w-full\">
\t\t\t<p class=\"font-semibold text-xl my-4\">Picture preview</p>
\t\t\t<img id=\"preview-uploaded-file\" class=\"hidden w-full h-56 object-cover\" src=\"\" alt=\"\"/>
\t\t</div>

\t\t<input type=\"submit\" id=\"upload-picture-btn\" class=\"w-full p-4 bg-transparent border-gray-400 border-solid border-2 hover:bg-gray-400 hover:cursor-pointer transition-all\" value=\"Choose this picture\"/>
\t</form>
</div>
", "components/settings/admin_slideshow_preferences.twig", "/var/www/zafkiel/src/Presentation/Templates/components/settings/admin_slideshow_preferences.twig");
    }
}
