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
class __TwigTemplate_1803b9bfcc3784c297fd6dd772f13728 extends Template
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
\t\t
\t\t";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((($_v0 = ($context["pictures"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0["defaultPictures"] ?? null) : null));
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
        foreach ($context['_seq'] as $context["key"] => $context["pictureGroup"]) {
            // line 9
            yield "\t\t\t<!--<div>
\t\t\t\t<p data-country=\"";
            // line 10
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "\" class=\"font-semibold text-xl my-4\">
\t\t\t\t\t";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "
\t\t\t\t</p>

\t\t\t\t<div class=\"w-full grid grid-cols-4 place-content-center gap-4\">
\t\t\t\t\t";
            // line 20
            yield "\t\t\t\t</div>
\t\t\t</div>-->

\t\t\t<div class=\"w-full grid grid-cols-4 place-content-center gap-4\">
\t\t\t\t";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["pictureGroup"]);
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
                // line 25
                yield "
\t\t\t\t\t";
                // line 26
                yield from $this->load("./components/settings/picture_slideshow_component.twig", 26)->unwrap()->yield(CoreExtension::merge($context, ["picture" => $context["picture"]]));
                // line 27
                yield "
\t\t\t\t";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['picture'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 29
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
        // line 31
        if (!$context['_iterated']) {
            // line 32
            yield "
\t\t\t<p>There aren't any default pictures. Please contact your administrator.</p>

\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['pictureGroup'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "\t</div>

\t<div id=\"user-pictures\" class=\"slideshow-tab-content hidden\">
\t\t<p class=\"font-semibold text-3xl mb-4\">
\t\t\tMy pictures
\t\t</p>
\t\t
\t\t";
        // line 43
        yield from $this->load("./components/settings/admin_user_pictures.twig", 43)->unwrap()->yield(CoreExtension::merge($context, ["pictures" => (($_v1 = ($context["pictures"] ?? null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1["userPictures"] ?? null) : null)]));
        // line 44
        yield "\t</div>

\t";
        // line 46
        yield from $this->load("./components/settings/pictures_options.twig", 46)->unwrap()->yield($context);
        // line 47
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
        return array (  171 => 47,  169 => 46,  165 => 44,  163 => 43,  154 => 36,  145 => 32,  143 => 31,  129 => 29,  114 => 27,  112 => 26,  109 => 25,  92 => 24,  86 => 20,  79 => 11,  75 => 10,  72 => 9,  54 => 8,  48 => 4,  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"pb-4\" id=\"toggle-pictures-slideshow\">

\t{% include './components/settings/pictures_options.twig' with {'name': name, 'api_key': api_key} %}

\t<div id=\"default-pictures\" class=\"slideshow-tab-content\">
\t\t<p class=\"font-semibold text-3xl\">Default pictures</p>
\t\t
\t\t{% for key, pictureGroup in pictures['defaultPictures'] %}
\t\t\t<!--<div>
\t\t\t\t<p data-country=\"{{ key }}\" class=\"font-semibold text-xl my-4\">
\t\t\t\t\t{{ key }}
\t\t\t\t</p>

\t\t\t\t<div class=\"w-full grid grid-cols-4 place-content-center gap-4\">
\t\t\t\t\t{#{% for picture in pictureGroup %}

\t\t\t\t\t\t{% include \"./components/settings/picture_slideshow_component.twig\" with {picture: picture} %}

\t\t\t\t\t{% endfor %}#}
\t\t\t\t</div>
\t\t\t</div>-->

\t\t\t<div class=\"w-full grid grid-cols-4 place-content-center gap-4\">
\t\t\t\t{% for picture in pictureGroup %}

\t\t\t\t\t{% include \"./components/settings/picture_slideshow_component.twig\" with {picture: picture} %}

\t\t\t\t{% endfor %}
\t\t\t</div>

\t\t{% else %}

\t\t\t<p>There aren't any default pictures. Please contact your administrator.</p>

\t\t{% endfor %}
\t</div>

\t<div id=\"user-pictures\" class=\"slideshow-tab-content hidden\">
\t\t<p class=\"font-semibold text-3xl mb-4\">
\t\t\tMy pictures
\t\t</p>
\t\t
\t\t{% include \"./components/settings/admin_user_pictures.twig\" with {pictures: pictures['userPictures']} %}
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
", "components/settings/admin_slideshow_preferences.twig", "C:\\wamp64\\www\\zafkiel\\src\\Presentation\\Templates\\components\\settings\\admin_slideshow_preferences.twig");
    }
}
