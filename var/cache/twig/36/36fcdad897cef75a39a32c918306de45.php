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

/* ./home/zafkiel_admin_manager.twig */
class __TwigTemplate_c23dd0acce243d8a067f8eab5a49ed4f extends Template
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
        yield "<div id=\"admins\" class=\"module-tab-content hidden w-3/4 p-4\">
\t<h1 class=\"text-3xl font-semibold mb-6\">Admins monitoring</h1>

\t<div class=\"flex flex-col justify-center items-center\">
\t\t<button type=\"button\" class=\"mb-6 px-4 py-2 bg-teal-700 text-gray-300 italic self-end\">
\t\t\t<i class=\"fa-solid fa-plus\"></i>&nbsp;&nbsp;New admin...
\t\t</button>

\t\t<table class=\"w-full border-collapse border-spacing-2\">
\t\t\t<thead class=\"text-left border-b-2 border-b-gray-300\">
\t\t\t\t<tr>
\t\t\t\t\t<th class=\"border-r-2 border-r-gray-300 p-2\">Admin information</th>
\t\t\t\t\t<th class=\"border-r-2 border-r-gray-300 p-2\">Is online</th>
\t\t\t\t\t<th class=\"p-2\">Admin status</th>
\t\t\t\t</tr>
\t\t\t</thead>

\t\t\t<tbody>
\t\t\t\t";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["admins"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["admin"]) {
            // line 20
            yield "\t\t\t\t\t<tr class=\"last:border-none border-b-2 border-b-gray-300\">
\t\t\t\t\t\t<td class=\"border-r-2 border-r-gray-300 p-2\">
\t\t\t\t\t\t\t<img ";
            // line 22
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "name", [], "any", false, false, false, 22) == CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "name", [], "any", false, false, false, 22))) ? ("data-profile-picture=\"currentAdmin\"") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data-profile-picture=" . CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "name", [], "any", false, false, false, 22)), "html", null, true)));
            yield " class=\"w-8 h-8 object-cover rounded-full inline\" src=\"";
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "personalData", [], "any", false, false, false, 22), "profilePicture", [], "any", false, false, false, 22)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "personalData", [], "any", false, false, false, 22), "profilePicture", [], "any", false, false, false, 22), "html", null, true)) : ("./img/backoffice/core/zafkiel_logo.png"));
            yield "\" alt=\"Profile picture of admin: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "name", [], "any", false, false, false, 22), "html", null, true);
            yield "\"/>
\t\t\t\t\t\t\t<p class=\"inline ml-2\">
\t\t\t\t\t\t\t\t";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "name", [], "any", false, false, false, 24), "html", null, true);
            yield "
\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"border-r-2 border-r-gray-300 p-2\">
\t\t\t\t\t\t\t<div class=\"flex flex-row justify-start items-center\">
\t\t\t\t\t\t\t\t<div class=\"w-4 h-4 rounded-full mr-2\" style=\"background-color: ";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "sessionStatus", [], "any", false, false, false, 29), "color", [], "any", false, false, false, 29), "html", null, true);
            yield ";\"></div>
\t\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t\t";
            // line 31
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "sessionStatus", [], "any", false, false, false, 31), "status", [], "any", false, false, false, 31)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Online") : ("Offline"));
            yield "
\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"p-2\">
\t\t\t\t\t\t\t";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["admin"], "status", [], "any", false, false, false, 36), "html", null, true);
            yield "
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"p-2\">
\t\t\t\t\t\t\t<i class=\" px-4 fa-solid fa-ellipsis-vertical hover:cursor-pointer\" onclick=\"openAdminStatusModal('admin-status-modal');\"></i>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['admin'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        yield "\t\t\t</tbody>
\t\t</table>
\t</div>
</div>

<div id=\"admin-status-modal\" class=\"hidden relative z-10\" aria-labelledby=\"modal-title\" role=\"dialog\" aria-modal=\"true\">

\t<div class=\"fixed inset-0 bg-transparent rounded-3xl transition-opacity\" aria-hidden=\"true\"></div>

\t<div class=\"fixed top-1/2 translate-y-[-50%] h-full flex justify-center items-center inset-0 z-10 rounded-b-lg sm:overflow-y-hidden overflow-y-auto\">
\t\t<div class=\"flex flex-col items-end justify-center w-full p-4 text-center sm:items-center sm:p-0\">

\t\t\t<div class=\"sticky top-0 w-4/5 bg-gray-100 px-4 py-3 flex flex-row justify-between items-center sm:px-6 sm:py-4 rounded-t-lg\">
\t\t\t\t<div class=\"flex flex-row justify-start items-center gap-x-4\">

\t\t\t\t\t<div class=\"mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10\">

\t\t\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewbox=\"0 0 24 24\" fill=\"none\" stroke=\"#156334\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><rect x=\"3\" y=\"3\" width=\"18\" height=\"18\" rx=\"2\"/><circle cx=\"8.5\" cy=\"8.5\" r=\"1.5\"/><path d=\"M20.4 14.5L16 10 4 20\"/></svg>

\t\t\t\t\t</div>

\t\t\t\t\t<h3 class=\"text-base font-semibold leading-6 text-gray-900\" id=\"modal-title\">View admin's status</h3>

\t\t\t\t</div>
\t\t\t\t<div id=\"close-admin-status-modal\" class=\"text-3xl hover:text-red-700 hover:cursor-pointer text-right\">&times;</div>
\t\t\t</div>

\t\t\t<div class=\"relative transform bg-white text-left shadow-xl transition-all sm:w-4/5\">

\t\t\t\t<div class=\"bg-white pb-4 pt-5 sm:pt-0 sm:pb-0\">
\t\t\t\t\t<div class=\"sm:flex sm:items-start\">
\t\t\t\t\t\t<div class=\"relative mt-3 text-center sm:mt-0 sm:text-left w-full\">

\t\t\t\t\t\t\t<div id=\"status-waiting-screen\" class=\"absolute left-0 top-0 flex-col gap-4 w-full h-full bg-white flex items-center justify-center\">
\t\t\t\t\t\t\t\t<div id=\"status-loading-spinner\" class=\"w-28 h-28 border-8 text-gray-500 text-4xl animate-slowSpin border-gray-300 flex items-center justify-center border-t-gray-500 rounded-full\">
\t\t\t\t\t\t\t\t\t<img class=\"animate-slowPulse\" src=\"./img/backoffice/core/zafkiel_logo.png\"/>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p id=\"status-loading-text\" class=\"mt-4 text-lg text-gray-600\">Loading images...</p>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div class=\"flex flex-row justify-between items-start h-96 text-stone-800 overflow-y-hidden\">

\t\t\t\t\t\t\t\t<div class=\"w-1/4 h-full border-r-2 border-r-solid border-r-gray-400 indent-4 overflow-y-auto\">
\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t<li id=\"admin-information\" class=\"admin-monitoring-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\">
\t\t\t\t\t\t\t\t\t\t\tAdmin information
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li id=\"admin-danger-zone\" class=\"admin-monitoring-tab-link p-4 pr-6 hover:bg-red-200 hover:cursor-pointer text-red-700 font-semibold\">
\t\t\t\t\t\t\t\t\t\t\tDanger zone
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div id=\"admin-status-modal-content\" class=\"w-full p-4 h-full overflow-auto\"></div>
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
        return "./home/zafkiel_admin_manager.twig";
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
        return array (  113 => 43,  100 => 36,  92 => 31,  87 => 29,  79 => 24,  70 => 22,  66 => 20,  62 => 19,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div id=\"admins\" class=\"module-tab-content hidden w-3/4 p-4\">
\t<h1 class=\"text-3xl font-semibold mb-6\">Admins monitoring</h1>

\t<div class=\"flex flex-col justify-center items-center\">
\t\t<button type=\"button\" class=\"mb-6 px-4 py-2 bg-teal-700 text-gray-300 italic self-end\">
\t\t\t<i class=\"fa-solid fa-plus\"></i>&nbsp;&nbsp;New admin...
\t\t</button>

\t\t<table class=\"w-full border-collapse border-spacing-2\">
\t\t\t<thead class=\"text-left border-b-2 border-b-gray-300\">
\t\t\t\t<tr>
\t\t\t\t\t<th class=\"border-r-2 border-r-gray-300 p-2\">Admin information</th>
\t\t\t\t\t<th class=\"border-r-2 border-r-gray-300 p-2\">Is online</th>
\t\t\t\t\t<th class=\"p-2\">Admin status</th>
\t\t\t\t</tr>
\t\t\t</thead>

\t\t\t<tbody>
\t\t\t\t{% for admin in admins %}
\t\t\t\t\t<tr class=\"last:border-none border-b-2 border-b-gray-300\">
\t\t\t\t\t\t<td class=\"border-r-2 border-r-gray-300 p-2\">
\t\t\t\t\t\t\t<img {{ (loggedAdmin.name == admin.name) ? 'data-profile-picture=\"currentAdmin\"' : 'data-profile-picture=' ~ admin.name }} class=\"w-8 h-8 object-cover rounded-full inline\" src=\"{{ (admin.personalData.profilePicture) ? admin.personalData.profilePicture : './img/backoffice/core/zafkiel_logo.png' }}\" alt=\"Profile picture of admin: {{ admin.name }}\"/>
\t\t\t\t\t\t\t<p class=\"inline ml-2\">
\t\t\t\t\t\t\t\t{{ admin.name }}
\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"border-r-2 border-r-gray-300 p-2\">
\t\t\t\t\t\t\t<div class=\"flex flex-row justify-start items-center\">
\t\t\t\t\t\t\t\t<div class=\"w-4 h-4 rounded-full mr-2\" style=\"background-color: {{ admin.sessionStatus.color }};\"></div>
\t\t\t\t\t\t\t\t<p>
\t\t\t\t\t\t\t\t\t{{ admin.sessionStatus.status ? 'Online' : 'Offline' }}
\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"p-2\">
\t\t\t\t\t\t\t{{ admin.status }}
\t\t\t\t\t\t</td>
\t\t\t\t\t\t<td class=\"p-2\">
\t\t\t\t\t\t\t<i class=\" px-4 fa-solid fa-ellipsis-vertical hover:cursor-pointer\" onclick=\"openAdminStatusModal('admin-status-modal');\"></i>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t{% endfor %}
\t\t\t</tbody>
\t\t</table>
\t</div>
</div>

<div id=\"admin-status-modal\" class=\"hidden relative z-10\" aria-labelledby=\"modal-title\" role=\"dialog\" aria-modal=\"true\">

\t<div class=\"fixed inset-0 bg-transparent rounded-3xl transition-opacity\" aria-hidden=\"true\"></div>

\t<div class=\"fixed top-1/2 translate-y-[-50%] h-full flex justify-center items-center inset-0 z-10 rounded-b-lg sm:overflow-y-hidden overflow-y-auto\">
\t\t<div class=\"flex flex-col items-end justify-center w-full p-4 text-center sm:items-center sm:p-0\">

\t\t\t<div class=\"sticky top-0 w-4/5 bg-gray-100 px-4 py-3 flex flex-row justify-between items-center sm:px-6 sm:py-4 rounded-t-lg\">
\t\t\t\t<div class=\"flex flex-row justify-start items-center gap-x-4\">

\t\t\t\t\t<div class=\"mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10\">

\t\t\t\t\t\t<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewbox=\"0 0 24 24\" fill=\"none\" stroke=\"#156334\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><rect x=\"3\" y=\"3\" width=\"18\" height=\"18\" rx=\"2\"/><circle cx=\"8.5\" cy=\"8.5\" r=\"1.5\"/><path d=\"M20.4 14.5L16 10 4 20\"/></svg>

\t\t\t\t\t</div>

\t\t\t\t\t<h3 class=\"text-base font-semibold leading-6 text-gray-900\" id=\"modal-title\">View admin's status</h3>

\t\t\t\t</div>
\t\t\t\t<div id=\"close-admin-status-modal\" class=\"text-3xl hover:text-red-700 hover:cursor-pointer text-right\">&times;</div>
\t\t\t</div>

\t\t\t<div class=\"relative transform bg-white text-left shadow-xl transition-all sm:w-4/5\">

\t\t\t\t<div class=\"bg-white pb-4 pt-5 sm:pt-0 sm:pb-0\">
\t\t\t\t\t<div class=\"sm:flex sm:items-start\">
\t\t\t\t\t\t<div class=\"relative mt-3 text-center sm:mt-0 sm:text-left w-full\">

\t\t\t\t\t\t\t<div id=\"status-waiting-screen\" class=\"absolute left-0 top-0 flex-col gap-4 w-full h-full bg-white flex items-center justify-center\">
\t\t\t\t\t\t\t\t<div id=\"status-loading-spinner\" class=\"w-28 h-28 border-8 text-gray-500 text-4xl animate-slowSpin border-gray-300 flex items-center justify-center border-t-gray-500 rounded-full\">
\t\t\t\t\t\t\t\t\t<img class=\"animate-slowPulse\" src=\"./img/backoffice/core/zafkiel_logo.png\"/>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<p id=\"status-loading-text\" class=\"mt-4 text-lg text-gray-600\">Loading images...</p>
\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t<div class=\"flex flex-row justify-between items-start h-96 text-stone-800 overflow-y-hidden\">

\t\t\t\t\t\t\t\t<div class=\"w-1/4 h-full border-r-2 border-r-solid border-r-gray-400 indent-4 overflow-y-auto\">
\t\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t\t<li id=\"admin-information\" class=\"admin-monitoring-tab-link p-4 pr-6 hover:bg-gray-200 hover:cursor-pointer\">
\t\t\t\t\t\t\t\t\t\t\tAdmin information
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t<li id=\"admin-danger-zone\" class=\"admin-monitoring-tab-link p-4 pr-6 hover:bg-red-200 hover:cursor-pointer text-red-700 font-semibold\">
\t\t\t\t\t\t\t\t\t\t\tDanger zone
\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div id=\"admin-status-modal-content\" class=\"w-full p-4 h-full overflow-auto\"></div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
", "./home/zafkiel_admin_manager.twig", "/var/www/zafkiel/src/Presentation/Templates/home/zafkiel_admin_manager.twig");
    }
}
