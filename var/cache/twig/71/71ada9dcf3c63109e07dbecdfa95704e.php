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

/* ./home/zafkiel_admin_settings.twig */
class __TwigTemplate_a848cd1a4c6682669755ae337c384b81 extends Template
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
        yield "<div id=\"admin-settings\" class=\"module-tab-content hidden w-3/4 p-4 overflow-y-auto\">
\t<h1 class=\"text-3xl font-semibold mb-6\">My settings</h1>

\t<div class=\"w-full\">
\t\t<div>
\t\t\t<p class=\"text-xl font-semibold\">
\t\t\t\tBackground
\t\t\t</p>

\t\t\t<div id=\"choose-background-container\" class=\"mt-6\">
\t\t\t\t";
        // line 11
        if ((($tmp = ($context["loggedAdmin"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 12
            yield "
\t\t\t\t\t";
            // line 13
            yield from $this->load("./components/slideshow/settings_slideshow.twig", 13)->unwrap()->yield(CoreExtension::merge($context, ["pref" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 13), "slideshowPictures", [], "any", false, false, false, 13)]));
            // line 14
            yield "
\t\t\t\t";
        } else {
            // line 16
            yield "
\t\t\t\t\t<img class=\"w-full h-56 object-cover\" src=\"";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = (($_v1 = (($_v2 = (($_v3 = (($_v4 = ($context["adminData"] ?? null)) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4["currentAdmin"] ?? null) : null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3["additionnal_data"] ?? null) : null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2["preferences"] ?? null) : null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1["backgroundPictures"] ?? null) : null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[0] ?? null) : null), "html", null, true);
            yield "\" alt=\"backgroundPicture\"/>

\t\t\t\t";
        }
        // line 20
        yield "
\t\t\t\t<button type=\"button\" class=\"px-4 py-2 mt-4 bg-gray-400 text-stone-800 rounded-md hover:cursor-pointer\" id=\"open-admin-slideshow\">
\t\t\t\t\tChoose a picture
\t\t\t\t</button>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

<div id=\"admin-slideshow-modal\" class=\"hidden relative z-10\" aria-labelledby=\"modal-title\" role=\"dialog\" aria-modal=\"true\">

\t<div class=\"fixed inset-0 bg-transparent rounded-3xl transition-opacity\" aria-hidden=\"true\"></div>

\t<div class=\"fixed top-1/2 translate-y-[-50%] h-full flex justify-center items-center inset-0 z-10 rounded-b-lg sm:overflow-y-hidden overflow-y-auto\">
\t\t<div class=\"flex flex-col items-end justify-center w-full p-4 text-center sm:items-center sm:p-0\">

\t\t\t<div class=\"sticky top-0 w-4/5 bg-gray-100 px-4 py-3 flex flex-row justify-between items-center sm:px-6 sm:py-4 rounded-t-lg\">
\t\t\t\t<div class=\"flex flex-row justify-start items-center gap-x-4\">

\t\t\t\t\t<div class=\"mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10\">

\t\t\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewbox=\"0 0 24 24\" fill=\"none\" stroke=\"#156334\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><rect x=\"3\" y=\"3\" width=\"18\" height=\"18\" rx=\"2\"/><circle cx=\"8.5\" cy=\"8.5\" r=\"1.5\"/><path d=\"M20.4 14.5L16 10 4 20\"/></svg>

\t\t\t\t\t</div>

\t\t\t\t\t<h3 class=\"text-base font-semibold leading-6 text-gray-900\" id=\"modal-title\">Change background pictures</h3>

\t\t\t\t</div>
\t\t\t\t<div id=\"close-admin-slideshow-modal\" class=\"text-3xl hover:text-red-700 hover:cursor-pointer text-right\">&times;</div>
\t\t\t</div>

\t\t\t<div class=\"relative transform bg-white text-left shadow-xl transition-all sm:w-4/5\">

\t\t\t\t<div class=\"bg-white pb-4 pt-5 sm:pt-0 sm:pb-0\">
\t\t\t\t\t<div class=\"sm:flex sm:items-start\">
\t\t\t\t\t\t<div class=\"relative mt-3 text-center sm:mt-0 sm:text-left w-full\">

\t\t\t\t\t\t\t<div id=\"slideshow-waiting-screen\" class=\"absolute left-0 top-0 flex-col gap-4 w-full h-full bg-white flex items-center justify-center\">
\t\t\t\t\t\t\t\t<div id=\"slideshow-loading-spinner\" class=\"w-28 h-28 border-8 text-gray-500 text-4xl animate-slowSpin border-gray-300 flex items-center justify-center border-t-gray-500 rounded-full\">
\t\t\t\t\t\t\t\t\t<img class=\"animate-slowPulse\" src=\"./public/img/backoffice/core/zafkiel_logo.png\"/>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p id=\"slideshow-loading-text\" class=\"mt-4 text-lg text-gray-600\">Loading images...</p>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<div class=\"flex flex-row justify-between items-start h-96 text-stone-800 overflow-y-hidden\">
\t\t\t\t\t\t\t\t\t<div class=\"w-1/4 h-full border-r-2 border-r-solid border-r-gray-400\">

\t\t\t\t\t\t\t\t\t\t<div class=\"w-full h-1/2 indent-4 overflow-y-auto\">
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"slideshow-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\" onclick=\"toggleSlideshowGallery('on');\">
\t\t\t\t\t\t\t\t\t\t\t\t\tDefault pictures
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li id=\"slideshow-refresh-user-pictures\" class=\"slideshow-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\" onclick=\"toggleSlideshowGallery('on');\">
\t\t\t\t\t\t\t\t\t\t\t\t\tMy gallery
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"slideshow-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\" onclick=\"toggleSlideshowGallery('off');\">
\t\t\t\t\t\t\t\t\t\t\t\t\tUpload a picture
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t<div class=\"flex items-end w-full h-[40%]\">
\t\t\t\t\t\t\t\t\t\t\t<details id=\"slideshow-preview-image\" class=\"w-full h-full indent-4 bg-gray-200\">
\t\t\t\t\t\t\t\t\t\t\t\t<summary class=\"font-semibold text-xl p-2\">Image preview</summary>

\t\t\t\t\t\t\t\t\t\t\t\t<img class=\"w-full h-full object-cover p-2\" id=\"slideshow-preview-image-thumbnail\" class=\"hidden\" alt=\"\"/>
\t\t\t\t\t\t\t\t\t\t\t</details>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t<div id=\"admin-slideshow-modal-content\" class=\"w-3/4 p-4 h-full overflow-auto\"></div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "./home/zafkiel_admin_settings.twig";
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
        return array (  74 => 20,  68 => 17,  65 => 16,  61 => 14,  59 => 13,  56 => 12,  54 => 11,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div id=\"admin-settings\" class=\"module-tab-content hidden w-3/4 p-4 overflow-y-auto\">
\t<h1 class=\"text-3xl font-semibold mb-6\">My settings</h1>

\t<div class=\"w-full\">
\t\t<div>
\t\t\t<p class=\"text-xl font-semibold\">
\t\t\t\tBackground
\t\t\t</p>

\t\t\t<div id=\"choose-background-container\" class=\"mt-6\">
\t\t\t\t{% if loggedAdmin %}

\t\t\t\t\t{% include './components/slideshow/settings_slideshow.twig' with {pref: loggedAdmin.personalData.slideshowPictures} %}

\t\t\t\t{% else %}

\t\t\t\t\t<img class=\"w-full h-56 object-cover\" src=\"{{ adminData['currentAdmin']['additionnal_data']['preferences']['backgroundPictures'][0] }}\" alt=\"backgroundPicture\"/>

\t\t\t\t{% endif %}

\t\t\t\t<button type=\"button\" class=\"px-4 py-2 mt-4 bg-gray-400 text-stone-800 rounded-md hover:cursor-pointer\" id=\"open-admin-slideshow\">
\t\t\t\t\tChoose a picture
\t\t\t\t</button>
\t\t\t</div>
\t\t</div>
\t</div>
</div>

<div id=\"admin-slideshow-modal\" class=\"hidden relative z-10\" aria-labelledby=\"modal-title\" role=\"dialog\" aria-modal=\"true\">

\t<div class=\"fixed inset-0 bg-transparent rounded-3xl transition-opacity\" aria-hidden=\"true\"></div>

\t<div class=\"fixed top-1/2 translate-y-[-50%] h-full flex justify-center items-center inset-0 z-10 rounded-b-lg sm:overflow-y-hidden overflow-y-auto\">
\t\t<div class=\"flex flex-col items-end justify-center w-full p-4 text-center sm:items-center sm:p-0\">

\t\t\t<div class=\"sticky top-0 w-4/5 bg-gray-100 px-4 py-3 flex flex-row justify-between items-center sm:px-6 sm:py-4 rounded-t-lg\">
\t\t\t\t<div class=\"flex flex-row justify-start items-center gap-x-4\">

\t\t\t\t\t<div class=\"mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10\">

\t\t\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewbox=\"0 0 24 24\" fill=\"none\" stroke=\"#156334\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><rect x=\"3\" y=\"3\" width=\"18\" height=\"18\" rx=\"2\"/><circle cx=\"8.5\" cy=\"8.5\" r=\"1.5\"/><path d=\"M20.4 14.5L16 10 4 20\"/></svg>

\t\t\t\t\t</div>

\t\t\t\t\t<h3 class=\"text-base font-semibold leading-6 text-gray-900\" id=\"modal-title\">Change background pictures</h3>

\t\t\t\t</div>
\t\t\t\t<div id=\"close-admin-slideshow-modal\" class=\"text-3xl hover:text-red-700 hover:cursor-pointer text-right\">&times;</div>
\t\t\t</div>

\t\t\t<div class=\"relative transform bg-white text-left shadow-xl transition-all sm:w-4/5\">

\t\t\t\t<div class=\"bg-white pb-4 pt-5 sm:pt-0 sm:pb-0\">
\t\t\t\t\t<div class=\"sm:flex sm:items-start\">
\t\t\t\t\t\t<div class=\"relative mt-3 text-center sm:mt-0 sm:text-left w-full\">

\t\t\t\t\t\t\t<div id=\"slideshow-waiting-screen\" class=\"absolute left-0 top-0 flex-col gap-4 w-full h-full bg-white flex items-center justify-center\">
\t\t\t\t\t\t\t\t<div id=\"slideshow-loading-spinner\" class=\"w-28 h-28 border-8 text-gray-500 text-4xl animate-slowSpin border-gray-300 flex items-center justify-center border-t-gray-500 rounded-full\">
\t\t\t\t\t\t\t\t\t<img class=\"animate-slowPulse\" src=\"./public/img/backoffice/core/zafkiel_logo.png\"/>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p id=\"slideshow-loading-text\" class=\"mt-4 text-lg text-gray-600\">Loading images...</p>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<div class=\"flex flex-row justify-between items-start h-96 text-stone-800 overflow-y-hidden\">
\t\t\t\t\t\t\t\t\t<div class=\"w-1/4 h-full border-r-2 border-r-solid border-r-gray-400\">

\t\t\t\t\t\t\t\t\t\t<div class=\"w-full h-1/2 indent-4 overflow-y-auto\">
\t\t\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"slideshow-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\" onclick=\"toggleSlideshowGallery('on');\">
\t\t\t\t\t\t\t\t\t\t\t\t\tDefault pictures
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li id=\"slideshow-refresh-user-pictures\" class=\"slideshow-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\" onclick=\"toggleSlideshowGallery('on');\">
\t\t\t\t\t\t\t\t\t\t\t\t\tMy gallery
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"slideshow-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\" onclick=\"toggleSlideshowGallery('off');\">
\t\t\t\t\t\t\t\t\t\t\t\t\tUpload a picture
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t<div class=\"flex items-end w-full h-[40%]\">
\t\t\t\t\t\t\t\t\t\t\t<details id=\"slideshow-preview-image\" class=\"w-full h-full indent-4 bg-gray-200\">
\t\t\t\t\t\t\t\t\t\t\t\t<summary class=\"font-semibold text-xl p-2\">Image preview</summary>

\t\t\t\t\t\t\t\t\t\t\t\t<img class=\"w-full h-full object-cover p-2\" id=\"slideshow-preview-image-thumbnail\" class=\"hidden\" alt=\"\"/>
\t\t\t\t\t\t\t\t\t\t\t</details>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>


\t\t\t\t\t\t\t\t\t<div id=\"admin-slideshow-modal-content\" class=\"w-3/4 p-4 h-full overflow-auto\"></div>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
", "./home/zafkiel_admin_settings.twig", "/var/www/zafkiel/src/Presentation/Templates/home/zafkiel_admin_settings.twig");
    }
}
