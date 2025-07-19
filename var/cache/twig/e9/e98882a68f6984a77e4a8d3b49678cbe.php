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

/* ./components/slideshow/slideshow.twig */
class __TwigTemplate_c446093ca325ff00a3d92f93b674d18c extends Template
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
        yield "<div class=\"w-full h-full relative\">

    <div id=\"slideshow-desktop-container\" class=\"relative w-full h-screen overflow-hidden\">
        ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["pref"] ?? null));
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
            // line 5
            yield "            <div class=\"slides-desktop absolute inset-0 opacity-0 transition-opacity duration-1000 hidden\">
                <img 
                    src=\"";
            // line 7
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["picture"], "picturePath", [], "any", false, false, false, 7), "html", null, true);
            yield "\" 
                    alt=\"Image ";
            // line 8
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 8), "html", null, true);
            yield "\" 
                    class=\"w-full h-full object-cover\"
                    loading=\"lazy\"
                >
                <div class=\"absolute bottom-4 left-4 bg-black bg-opacity-50 text-white p-2 rounded\">
                    ";
            // line 13
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::last($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["picture"], "picturePath", [], "any", false, false, false, 13), "/")), "html", null, true);
            yield "
                </div>
            </div>
        ";
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
        // line 17
        yield "    </div>
    
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "./components/slideshow/slideshow.twig";
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
        return array (  98 => 17,  80 => 13,  72 => 8,  68 => 7,  64 => 5,  47 => 4,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"w-full h-full relative\">

    <div id=\"slideshow-desktop-container\" class=\"relative w-full h-screen overflow-hidden\">
        {% for picture in pref %}
            <div class=\"slides-desktop absolute inset-0 opacity-0 transition-opacity duration-1000 hidden\">
                <img 
                    src=\"{{ picture.picturePath }}\" 
                    alt=\"Image {{ loop.index }}\" 
                    class=\"w-full h-full object-cover\"
                    loading=\"lazy\"
                >
                <div class=\"absolute bottom-4 left-4 bg-black bg-opacity-50 text-white p-2 rounded\">
                    {{ picture.picturePath|split('/')|last }}
                </div>
            </div>
        {% endfor %}
    </div>
    
</div>", "./components/slideshow/slideshow.twig", "/var/www/zafkiel/src/Presentation/Templates/components/slideshow/slideshow.twig");
    }
}
