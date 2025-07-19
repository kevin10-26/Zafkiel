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

/* home/zafkiel_desktop.twig */
class __TwigTemplate_4660a4539bb05af114a32a9b663856b6 extends Template
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
        yield "<!DOCTYPE html>
<html lang=\"fr\">
\t<head>
\t\t<meta charset=\"UTF-8\"/>
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>

\t\t<link rel=\"stylesheet\" href=\"./public/css/output.css\"/>
\t\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css\" integrity=\"sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"/>

\t\t<title>Zafkiel backoffice</title>
\t</head>
\t<body class=\"relative\">

\t\t<div class=\"absolute h-screen w-full\">
\t\t\t";
        // line 15
        if ((($tmp = ($context["loggedAdmin"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "
\t\t\t\t";
            // line 17
            yield from $this->load("./components/slideshow/slideshow.twig", 17)->unwrap()->yield(CoreExtension::merge($context, ["pref" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 17), "slideshowPictures", [], "any", false, false, false, 17)]));
            // line 18
            yield "
\t\t\t";
        } else {
            // line 20
            yield "
\t\t\t\t<img class=\"w-full h-56 object-cover\" src=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v0 = (($_v1 = (($_v2 = (($_v3 = (($_v4 = ($context["adminData"] ?? null)) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4["currentAdmin"] ?? null) : null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3["additionnal_data"] ?? null) : null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2["preferences"] ?? null) : null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1["backgroundPictures"] ?? null) : null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0[0] ?? null) : null), "html", null, true);
            yield "\" alt=\"backgroundPicture\"/>

\t\t\t";
        }
        // line 24
        yield "\t\t</div>

\t\t<div class=\"flex flex-col justify-between items-center h-screen bg-cover bg-no-repeat\">
\t\t\t<main id=\"main-module\" class=\"module z-10 flex flex-row justify-between my-10 w-3/4 h-3/4 rounded-3xl backdrop-blur-sm bg-stone-800/[.6] text-gray-300\">
\t\t\t\t<div class=\"flex flex-col justify-between items-center w-1/4 h-full py-6 bg-stone-900/[.7] rounded-l-3xl\">
\t\t\t\t\t<div class=\"relative text-xl w-full h-4/5 overflow-y-auto\">
\t\t\t\t\t\t<img data-profile-picture=\"currentAdmin\" class=\"block w-44 h-44 mx-auto rounded-full object-cover border-2 border-solid border-white\" src=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 30), "profilePicture", [], "any", false, false, false, 30), "html", null, true);
        yield "\" alt=\"Photo de profil\"/>

\t\t\t\t\t\t<div class=\"flex flex-col justify-between items-center w-full my-4\">
\t\t\t\t\t\t\t<ul class=\"list-none w-full\">
\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'desktop-tab');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-house\"></i>&nbsp;&nbsp;Desktop
\t\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'admin-settings');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-gear\"></i>&nbsp;&nbsp;Settings
\t\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'admin-profile');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-user\"></i>&nbsp;&nbsp;My profile&nbsp;&nbsp;
\t\t\t\t\t\t\t\t\t<i id=\"warning-profile-icon\" class=\"fa-solid fa-triangle-exclamation color-[#F0B100]\" style=\"display: none;\"></i>
\t\t\t\t\t\t\t\t\t<span class=\"hidden\" id=\"alerts-number-profile\"></span>
\t\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'admins');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-user-lock\"></i>&nbsp;&nbsp;Administrators
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"flex flex-row justify-evenly items-center gap-x-8 w-full h-1/5 mx-auto text-3xl\">

\t\t\t\t\t\t<div class=\"relative\">
\t\t\t\t\t\t\t<p class=\"absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] text-sm font-semibold\">9+</p>
\t\t\t\t\t\t\t<i class=\"fa-regular fa-bell text-5xl\"></i>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"flex flex-col justify-center items-center\">
\t\t\t\t\t\t\t<div id=\"zafkiel-taskbar-clock\" class=\"text-sm\"></div>
\t\t\t\t\t\t\t<div id=\"zafkiel-taskbar-date\" class=\"text-sm\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"desktop-tab\" class=\"module-tab-content w-3/4\">
\t\t\t\t\t<form action=\"#\" method=\"POST\" class=\"w-full\" onsubmit=\"displayResults(event);\">
\t\t\t\t\t\t<div class=\"relative w-2/4 mx-auto my-8\">
\t\t\t\t\t\t\t<input type=\"search\" list=\"services-list\" id=\"search-service\" name=\"search-service\" placeholder=\"Search for a service...\" class=\"absolute left-1/2 translate-x-[-50%] w-full rounded-xl px-4 py-2 bg-stone-800\" onkeyup=\"displayResults(event)\"/>

\t\t\t\t\t\t\t<button class=\"absolute right-3 translate-y-1/3\" type=\"submit\">
\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-magnifying-glass\"></i>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<datalist id=\"services-list\">
\t\t\t\t\t\t\t";
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["apps"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["app"]) {
            // line 81
            yield "
\t\t\t\t\t\t\t\t<option value=\"";
            // line 82
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["app"], "name", [], "any", false, false, false, 82), "html", null, true);
            yield "\" data-path=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["app"], "favicon", [], "any", false, false, false, 82), "html", null, true);
            yield "\">
\t\t\t\t\t\t\t\t\t";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["app"], "name", [], "any", false, false, false, 83), "html", null, true);
            yield "
\t\t\t\t\t\t\t\t</option>

\t\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['app'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        yield "\t\t\t\t\t\t</datalist>
\t\t\t\t\t</form>

\t\t\t\t\t<div class=\"w-4/5 mx-auto mt-28 mb-6\">
\t\t\t\t\t\t<p class=\"w-full font-semibold text-2xl\">My services</p>
\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"services-container\" class=\"grid grid-cols-3 gap-x-6 w-4/5 h-3/5 mx-auto overflow-y-auto\">
\t\t\t\t\t\t";
        // line 95
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["apps"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["app"]) {
            // line 96
            yield "
\t\t\t\t\t\t\t<div class=\"w-44 h-44 p-2 hover:bg-gray-400/[.5] hover:cursor-pointer\" onclick=\"openApp(event, '";
            // line 97
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "');\">
\t\t\t\t\t\t\t\t<img class=\"block w-28 h-28 mx-auto rounded-full object-cover\" src=\"";
            // line 98
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["app"], "favicon", [], "any", false, false, false, 98), "html", null, true);
            yield "\" alt=\"Icon for app: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["app"], "name", [], "any", false, false, false, 98), "html", null, true);
            yield "\"/>

\t\t\t\t\t\t\t\t<p class=\"font-semibold text-center mt-2 text-lg\">
\t\t\t\t\t\t\t\t\t";
            // line 101
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["app"], "name", [], "any", false, false, false, 101), "html", null, true);
            yield "
\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['app'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 106
        yield "\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t";
        // line 109
        yield from $this->load("./home/zafkiel_admin_manager.twig", 109)->unwrap()->yield(CoreExtension::merge($context, ["data" => ($context["adminData"] ?? null)]));
        // line 110
        yield "\t\t\t\t";
        yield from $this->load("./home/zafkiel_admin_profile.twig", 110)->unwrap()->yield(CoreExtension::merge($context, ["data" => ($context["adminData"] ?? null)]));
        // line 111
        yield "\t\t\t\t";
        yield from $this->load("./home/zafkiel_admin_settings.twig", 111)->unwrap()->yield(CoreExtension::merge($context, ["data" => ($context["adminData"] ?? null)]));
        // line 112
        yield "\t\t\t</main>

\t\t\t";
        // line 114
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["templates"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["template"]) {
            // line 115
            yield "\t\t\t\t";
            yield $context["template"];
            yield "
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['template'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        yield "
\t\t\t<footer class=\"flex flex-row justify-evenly items-center w-full gap-x-6 h-16 backdrop-blur-sm bg-stone-800/[.8] text-gray-300 z-10\">
\t\t\t\t<div class=\"flex flex-row justify-start items-center gap-x-6 w-4/5 h-full mx-auto text-3xl\">
\t\t\t\t\t<img class=\"w-auto h-full p-2 hover:bg-gray-400/[.4]\" src=\"./public/img/backoffice/core/zafkiel_logo.png\" alt=\"Zafkiel logo.\"/>

\t\t\t\t\t<div class=\"flex flex-row items-center gap-x-0.5 h-full border-x-2 border-solid px-6\">
\t\t\t\t\t\t<i class=\"fa-solid fa-power-off items-center h-full p-4 hover:bg-gray-400/[.4]\" style=\"display: flex\"></i>
\t\t\t\t\t\t<i class=\"fa-solid fa-user items-center h-full p-4 hover:bg-gray-400/[.4]\" style=\"display: flex\"></i>
\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-right-arrow-left items-center h-full p-4 hover:bg-gray-400/[.4]\" style=\"display: flex\"></i>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"flex flex-row justify-start items-start gap-x-0.5\">
\t\t\t\t\t\t";
        // line 129
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((($_v5 = (($_v6 = ($context["components"] ?? null)) && is_array($_v6) || $_v6 instanceof ArrayAccess ? ($_v6["modules"] ?? null) : null)) && is_array($_v5) || $_v5 instanceof ArrayAccess ? ($_v5["items"] ?? null) : null));
        foreach ($context['_seq'] as $context["key"] => $context["module"]) {
            // line 130
            yield "\t\t\t\t\t\t\t";
            if ((($tmp = (($_v7 = $context["module"]) && is_array($_v7) || $_v7 instanceof ArrayAccess ? ($_v7["pinned"] ?? null) : null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 131
                yield "
\t\t\t\t\t\t\t\t<div class=\"p-2 hover:bg-gray-400/[.4]\" onclick=\"openService(event, '";
                // line 132
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                yield "')\">
\t\t\t\t\t\t\t\t\t<img class=\"w-12 h-12\" src=\"";
                // line 133
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v8 = (($_v9 = ($context["components"] ?? null)) && is_array($_v9) || $_v9 instanceof ArrayAccess ? ($_v9["modules"] ?? null) : null)) && is_array($_v8) || $_v8 instanceof ArrayAccess ? ($_v8["moduleIconsPath"] ?? null) : null), "html", null, true);
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v10 = $context["module"]) && is_array($_v10) || $_v10 instanceof ArrayAccess ? ($_v10["path"] ?? null) : null), "html", null, true);
                yield "\" alt=\"Icon for service : ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v11 = $context["module"]) && is_array($_v11) || $_v11 instanceof ArrayAccess ? ($_v11["name"] ?? null) : null), "html", null, true);
                yield "\"/>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t";
            }
            // line 137
            yield "\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['module'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        yield "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</footer>
\t\t</div>

\t\t<div id=\"snackbar-container\" class=\"flex flex-col fixed bottom-10 left-1/2 translate-x-[-50%] max-w-screen-sm bg-transparent z-10\"></div>

\t\t<script src=\"./public/js/zafkiel/auth.js\"></script>
\t\t<script src=\"./public/js/zafkiel/frontend_interactions.js\"></script>
\t\t<script src=\"./public/js/zafkiel/slideshow.conf.js\"></script>
\t\t<script src=\"./public/js/zafkiel/admin_profile.conf.js\"></script>
\t\t<script src=\"./public/js/zafkiel/ZafkielSnackbar.js\"></script>

\t\t<script src=\"./public/js/zafkiel/ZafkielFrontend.js\"></script>
\t\t<script src=\"./public/js/zafkiel/desktop.js\"></script>

\t\t<script src=\"./public/js/zafkiel/handlers.js\"></script>
\t</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/zafkiel_desktop.twig";
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
        return array (  277 => 138,  271 => 137,  260 => 133,  256 => 132,  253 => 131,  250 => 130,  246 => 129,  232 => 117,  223 => 115,  219 => 114,  215 => 112,  212 => 111,  209 => 110,  207 => 109,  202 => 106,  191 => 101,  183 => 98,  179 => 97,  176 => 96,  172 => 95,  162 => 87,  152 => 83,  146 => 82,  143 => 81,  139 => 80,  86 => 30,  78 => 24,  72 => 21,  69 => 20,  65 => 18,  63 => 17,  60 => 16,  58 => 15,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
\t<head>
\t\t<meta charset=\"UTF-8\"/>
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>

\t\t<link rel=\"stylesheet\" href=\"./public/css/output.css\"/>
\t\t<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css\" integrity=\"sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"/>

\t\t<title>Zafkiel backoffice</title>
\t</head>
\t<body class=\"relative\">

\t\t<div class=\"absolute h-screen w-full\">
\t\t\t{% if loggedAdmin %}

\t\t\t\t{% include './components/slideshow/slideshow.twig' with {pref: loggedAdmin.personalData.slideshowPictures} %}

\t\t\t{% else %}

\t\t\t\t<img class=\"w-full h-56 object-cover\" src=\"{{ adminData['currentAdmin']['additionnal_data']['preferences']['backgroundPictures'][0] }}\" alt=\"backgroundPicture\"/>

\t\t\t{% endif %}
\t\t</div>

\t\t<div class=\"flex flex-col justify-between items-center h-screen bg-cover bg-no-repeat\">
\t\t\t<main id=\"main-module\" class=\"module z-10 flex flex-row justify-between my-10 w-3/4 h-3/4 rounded-3xl backdrop-blur-sm bg-stone-800/[.6] text-gray-300\">
\t\t\t\t<div class=\"flex flex-col justify-between items-center w-1/4 h-full py-6 bg-stone-900/[.7] rounded-l-3xl\">
\t\t\t\t\t<div class=\"relative text-xl w-full h-4/5 overflow-y-auto\">
\t\t\t\t\t\t<img data-profile-picture=\"currentAdmin\" class=\"block w-44 h-44 mx-auto rounded-full object-cover border-2 border-solid border-white\" src=\"{{ loggedAdmin.personalData.profilePicture }}\" alt=\"Photo de profil\"/>

\t\t\t\t\t\t<div class=\"flex flex-col justify-between items-center w-full my-4\">
\t\t\t\t\t\t\t<ul class=\"list-none w-full\">
\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'desktop-tab');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-house\"></i>&nbsp;&nbsp;Desktop
\t\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'admin-settings');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-gear\"></i>&nbsp;&nbsp;Settings
\t\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'admin-profile');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-user\"></i>&nbsp;&nbsp;My profile&nbsp;&nbsp;
\t\t\t\t\t\t\t\t\t<i id=\"warning-profile-icon\" class=\"fa-solid fa-triangle-exclamation color-[#F0B100]\" style=\"display: none;\"></i>
\t\t\t\t\t\t\t\t\t<span class=\"hidden\" id=\"alerts-number-profile\"></span>
\t\t\t\t\t\t\t\t</li>

\t\t\t\t\t\t\t\t<li onclick=\"displayTab(event, 'module', 'admins');\" class=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\">
\t\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-user-lock\"></i>&nbsp;&nbsp;Administrators
\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"flex flex-row justify-evenly items-center gap-x-8 w-full h-1/5 mx-auto text-3xl\">

\t\t\t\t\t\t<div class=\"relative\">
\t\t\t\t\t\t\t<p class=\"absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] text-sm font-semibold\">9+</p>
\t\t\t\t\t\t\t<i class=\"fa-regular fa-bell text-5xl\"></i>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"flex flex-col justify-center items-center\">
\t\t\t\t\t\t\t<div id=\"zafkiel-taskbar-clock\" class=\"text-sm\"></div>
\t\t\t\t\t\t\t<div id=\"zafkiel-taskbar-date\" class=\"text-sm\"></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"desktop-tab\" class=\"module-tab-content w-3/4\">
\t\t\t\t\t<form action=\"#\" method=\"POST\" class=\"w-full\" onsubmit=\"displayResults(event);\">
\t\t\t\t\t\t<div class=\"relative w-2/4 mx-auto my-8\">
\t\t\t\t\t\t\t<input type=\"search\" list=\"services-list\" id=\"search-service\" name=\"search-service\" placeholder=\"Search for a service...\" class=\"absolute left-1/2 translate-x-[-50%] w-full rounded-xl px-4 py-2 bg-stone-800\" onkeyup=\"displayResults(event)\"/>

\t\t\t\t\t\t\t<button class=\"absolute right-3 translate-y-1/3\" type=\"submit\">
\t\t\t\t\t\t\t\t<i class=\"fa-solid fa-magnifying-glass\"></i>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<datalist id=\"services-list\">
\t\t\t\t\t\t\t{% for app in apps %}

\t\t\t\t\t\t\t\t<option value=\"{{ app.name }}\" data-path=\"{{ app.favicon }}\">
\t\t\t\t\t\t\t\t\t{{ app.name }}
\t\t\t\t\t\t\t\t</option>

\t\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t\t</datalist>
\t\t\t\t\t</form>

\t\t\t\t\t<div class=\"w-4/5 mx-auto mt-28 mb-6\">
\t\t\t\t\t\t<p class=\"w-full font-semibold text-2xl\">My services</p>
\t\t\t\t\t</div>

\t\t\t\t\t<div id=\"services-container\" class=\"grid grid-cols-3 gap-x-6 w-4/5 h-3/5 mx-auto overflow-y-auto\">
\t\t\t\t\t\t{% for key, app in apps %}

\t\t\t\t\t\t\t<div class=\"w-44 h-44 p-2 hover:bg-gray-400/[.5] hover:cursor-pointer\" onclick=\"openApp(event, '{{ key }}');\">
\t\t\t\t\t\t\t\t<img class=\"block w-28 h-28 mx-auto rounded-full object-cover\" src=\"{{ app.favicon }}\" alt=\"Icon for app: {{ app.name }}\"/>

\t\t\t\t\t\t\t\t<p class=\"font-semibold text-center mt-2 text-lg\">
\t\t\t\t\t\t\t\t\t{{ app.name }}
\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t{% include './home/zafkiel_admin_manager.twig' with {data: adminData} %}
\t\t\t\t{% include './home/zafkiel_admin_profile.twig' with {data: adminData} %}
\t\t\t\t{% include './home/zafkiel_admin_settings.twig' with {data: adminData} %}
\t\t\t</main>

\t\t\t{% for template in templates %}
\t\t\t\t{{ template|raw }}
\t\t\t{% endfor %}

\t\t\t<footer class=\"flex flex-row justify-evenly items-center w-full gap-x-6 h-16 backdrop-blur-sm bg-stone-800/[.8] text-gray-300 z-10\">
\t\t\t\t<div class=\"flex flex-row justify-start items-center gap-x-6 w-4/5 h-full mx-auto text-3xl\">
\t\t\t\t\t<img class=\"w-auto h-full p-2 hover:bg-gray-400/[.4]\" src=\"./public/img/backoffice/core/zafkiel_logo.png\" alt=\"Zafkiel logo.\"/>

\t\t\t\t\t<div class=\"flex flex-row items-center gap-x-0.5 h-full border-x-2 border-solid px-6\">
\t\t\t\t\t\t<i class=\"fa-solid fa-power-off items-center h-full p-4 hover:bg-gray-400/[.4]\" style=\"display: flex\"></i>
\t\t\t\t\t\t<i class=\"fa-solid fa-user items-center h-full p-4 hover:bg-gray-400/[.4]\" style=\"display: flex\"></i>
\t\t\t\t\t\t<i class=\"fa-solid fa-arrow-right-arrow-left items-center h-full p-4 hover:bg-gray-400/[.4]\" style=\"display: flex\"></i>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"flex flex-row justify-start items-start gap-x-0.5\">
\t\t\t\t\t\t{% for key, module in components['modules']['items'] %}
\t\t\t\t\t\t\t{% if module['pinned'] %}

\t\t\t\t\t\t\t\t<div class=\"p-2 hover:bg-gray-400/[.4]\" onclick=\"openService(event, '{{ key }}')\">
\t\t\t\t\t\t\t\t\t<img class=\"w-12 h-12\" src=\"{{ components['modules']['moduleIconsPath'] }}/{{ module['path'] }}\" alt=\"Icon for service : {{ module['name'] }}\"/>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</footer>
\t\t</div>

\t\t<div id=\"snackbar-container\" class=\"flex flex-col fixed bottom-10 left-1/2 translate-x-[-50%] max-w-screen-sm bg-transparent z-10\"></div>

\t\t<script src=\"./public/js/zafkiel/auth.js\"></script>
\t\t<script src=\"./public/js/zafkiel/frontend_interactions.js\"></script>
\t\t<script src=\"./public/js/zafkiel/slideshow.conf.js\"></script>
\t\t<script src=\"./public/js/zafkiel/admin_profile.conf.js\"></script>
\t\t<script src=\"./public/js/zafkiel/ZafkielSnackbar.js\"></script>

\t\t<script src=\"./public/js/zafkiel/ZafkielFrontend.js\"></script>
\t\t<script src=\"./public/js/zafkiel/desktop.js\"></script>

\t\t<script src=\"./public/js/zafkiel/handlers.js\"></script>
\t</body>
</html>
", "home/zafkiel_desktop.twig", "C:\\wamp64\\www\\zafkiel\\src\\Presentation\\Templates\\home\\zafkiel_desktop.twig");
    }
}
