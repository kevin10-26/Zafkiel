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

/* ./home/zafkiel_admin_profile.twig */
class __TwigTemplate_6a7b1e7a0dff3618f0123ca52dbf16b8 extends Template
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
        yield "<div id=\"admin-profile\" class=\"module-tab-content relative hidden w-3/4 p-4 overflow-y-auto\">
    <div id=\"warning-profile-message\" class=\"fixed top-2 right-5 h-10 hidden flex-row justify-between items-center text-center\">
        <div class=\"h-full bg-yellow-600 px-4 py-2 rounded-l-md\">
            You have some unsaved changes. Please save them before leaving!
        </div>
        <div class=\"flex justify-center items-center h-full bg-yellow-700 px-4 py-2 rounded-r-md text-xl hover:cursor-pointer\" onclick=\"toggleChangesWarning();\">
            &times;
        </div>
    </div>

    <h1 class=\"text-3xl font-semibold mb-6\">My admin profile</h1>

    <form id=\"change-admin-data\" class=\"grid grid-cols-2 p-4\">
        
        ";
        // line 15
        yield from $this->load("./components/profile/control_button.twig", 15)->unwrap()->yield($context);
        // line 16
        yield "        
        <div class=\"w-fit place-self-center\">
            <img data-profile-picture=\"currentAdmin\" class=\"w-36 h-36 rounded-full object-cover\" src=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 18), "profilePicture", [], "any", false, false, false, 18), "html", null, true);
        yield "\" alt=\"Your profile picture.\" />

            <div>
                <label class=\"block mt-4 mx-auto px-4 py-2 text-center border-solid border-gray-400 rounded-md hover:border-2 hover:bg-gray-200 hover:text-stone-800 hover:cursor-pointer transition-all\" for=\"change-profile-picture\">Choose a file</label><br />
                <input class=\"hidden\" type=\"file\" onchange=\"updateAdminProfilePicture(event);\" id=\"change-profile-picture\" placeholder=\"Change my profile picture...\" />
            </div>
        </div>

        <div>
            <div>
                <label for=\"admin-first-name\" class=\"underline\">Your first name</label><br />
                <input type=\"text\" id=\"admin-first-name\" data-value=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 29), "firstName", [], "any", false, false, false, 29), "html", null, true);
        yield "\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your first name...\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 29), "firstName", [], "any", false, false, false, 29), "html", null, true);
        yield "\" />
            </div>

            <div class=\"mt-4\">
                <label for=\"admin-last-name\" class=\"underline\">Your last name</label><br />
                <input type=\"text\" id=\"admin-last-name\" data-value=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 34), "lastName", [], "any", false, false, false, 34), "html", null, true);
        yield "\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your last name...\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 34), "lastName", [], "any", false, false, false, 34), "html", null, true);
        yield "\" />
            </div>
        </div>

        <div class=\"mr-6\">
            <label for=\"admin-username\" class=\"underline\">Your username</label>
            <input type=\"text\" id=\"admin-username\" data-value=\"";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "name", [], "any", false, false, false, 40), "html", null, true);
        yield "\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your username...\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "name", [], "any", false, false, false, 40), "html", null, true);
        yield "\" />
        </div>
        
        <div>
            <label for=\"admin-email\" class=\"underline\">Your email address</label>
            <input type=\"text\" id=\"admin-email\" data-value=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "emailAddr", [], "any", false, false, false, 45), "html", null, true);
        yield "\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your email address...\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "emailAddr", [], "any", false, false, false, 45), "html", null, true);
        yield "\" />
        </div>

        <div class=\"col-span-2 mt-6\">
            <p class=\"text-2xl font-semibold mb-2\">
                Change my password
            </p>

            <div class=\"flex flex-row justify-between items-center gap-x-4\">
                <div class=\"w-full\">
                    <label for=\"admin-new-password\" class=\"underline\">New password</label>
                    <div class=\"relative\">
                        <input type=\"password\" id=\"admin-new-password\" name=\"password\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your new password...\" />
                        <i class=\"fa-solid fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 cursor-pointer\" onclick=\"togglePasswordVisibility('admin-new-password', this)\"></i>
                    </div>
                    <p id=\"profile-password-issue\" class=\"hidden text-red-700 font-semibold mt-2\"></p>
                </div>

                <div class=\"w-full\">
                    <label for=\"admin-confirm-password\" class=\"underline\">Confirm password</label>
                    <div class=\"relative\">
                        <input type=\"password\" id=\"admin-confirm-password\" name=\"password\" data-value=\"\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Confirm your new password...\" />
                        <i class=\"fa-solid fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 cursor-pointer\" onclick=\"togglePasswordVisibility('admin-confirm-password', this)\"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"mt-6 col-span-2\">
            <p class=\"text-2xl font-semibold mb-2\">
                Coordinates
            </p>

            <div class=\"flex flex-row justify-between items-center gap-x-4\">
                <div class=\"w-full\">
                    <label for=\"admin-address\" class=\"underline\">Address</label>
                    <input type=\"text\" id=\"admin-address\" data-value=\"";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 81), "street", [], "any", false, false, false, 81), "html", null, true);
        yield "\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your address...\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 81), "street", [], "any", false, false, false, 81), "html", null, true);
        yield "\" />
                </div>

                <div class=\"w-full\">
                    <label for=\"admin-city-code\" class=\"underline\">ZIP / Postal code</label>
                    <input type=\"text\" id=\"admin-city-code\" data-value=\"";
        // line 86
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 86), "postalCode", [], "any", false, false, false, 86), "html", null, true);
        yield "\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your city code...\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 86), "postalCode", [], "any", false, false, false, 86), "html", null, true);
        yield "\" />
                </div>

                <div class=\"w-full\">
                    <label for=\"admin-city\" class=\"underline\">City name</label>
                    <input type=\"text\" id=\"admin-city\" data-value=\"";
        // line 91
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 91), "city", [], "any", false, false, false, 91), "html", null, true);
        yield "\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your city...\" value=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["loggedAdmin"] ?? null), "personalData", [], "any", false, false, false, 91), "city", [], "any", false, false, false, 91), "html", null, true);
        yield "\" />
                </div>
            </div>
        </div>

        ";
        // line 96
        yield from $this->load("./components/profile/control_button.twig", 96)->unwrap()->yield($context);
        // line 97
        yield "    </form>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "./home/zafkiel_admin_profile.twig";
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
        return array (  182 => 97,  180 => 96,  170 => 91,  160 => 86,  150 => 81,  109 => 45,  99 => 40,  88 => 34,  78 => 29,  64 => 18,  60 => 16,  58 => 15,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div id=\"admin-profile\" class=\"module-tab-content relative hidden w-3/4 p-4 overflow-y-auto\">
    <div id=\"warning-profile-message\" class=\"fixed top-2 right-5 h-10 hidden flex-row justify-between items-center text-center\">
        <div class=\"h-full bg-yellow-600 px-4 py-2 rounded-l-md\">
            You have some unsaved changes. Please save them before leaving!
        </div>
        <div class=\"flex justify-center items-center h-full bg-yellow-700 px-4 py-2 rounded-r-md text-xl hover:cursor-pointer\" onclick=\"toggleChangesWarning();\">
            &times;
        </div>
    </div>

    <h1 class=\"text-3xl font-semibold mb-6\">My admin profile</h1>

    <form id=\"change-admin-data\" class=\"grid grid-cols-2 p-4\">
        
        {% include './components/profile/control_button.twig' %}
        
        <div class=\"w-fit place-self-center\">
            <img data-profile-picture=\"currentAdmin\" class=\"w-36 h-36 rounded-full object-cover\" src=\"{{ loggedAdmin.personalData.profilePicture }}\" alt=\"Your profile picture.\" />

            <div>
                <label class=\"block mt-4 mx-auto px-4 py-2 text-center border-solid border-gray-400 rounded-md hover:border-2 hover:bg-gray-200 hover:text-stone-800 hover:cursor-pointer transition-all\" for=\"change-profile-picture\">Choose a file</label><br />
                <input class=\"hidden\" type=\"file\" onchange=\"updateAdminProfilePicture(event);\" id=\"change-profile-picture\" placeholder=\"Change my profile picture...\" />
            </div>
        </div>

        <div>
            <div>
                <label for=\"admin-first-name\" class=\"underline\">Your first name</label><br />
                <input type=\"text\" id=\"admin-first-name\" data-value=\"{{ loggedAdmin.personalData.firstName }}\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your first name...\" value=\"{{ loggedAdmin.personalData.firstName }}\" />
            </div>

            <div class=\"mt-4\">
                <label for=\"admin-last-name\" class=\"underline\">Your last name</label><br />
                <input type=\"text\" id=\"admin-last-name\" data-value=\"{{ loggedAdmin.personalData.lastName }}\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your last name...\" value=\"{{ loggedAdmin.personalData.lastName }}\" />
            </div>
        </div>

        <div class=\"mr-6\">
            <label for=\"admin-username\" class=\"underline\">Your username</label>
            <input type=\"text\" id=\"admin-username\" data-value=\"{{ loggedAdmin.name }}\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your username...\" value=\"{{ loggedAdmin.name }}\" />
        </div>
        
        <div>
            <label for=\"admin-email\" class=\"underline\">Your email address</label>
            <input type=\"text\" id=\"admin-email\" data-value=\"{{ loggedAdmin.emailAddr }}\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your email address...\" value=\"{{ loggedAdmin.emailAddr }}\" />
        </div>

        <div class=\"col-span-2 mt-6\">
            <p class=\"text-2xl font-semibold mb-2\">
                Change my password
            </p>

            <div class=\"flex flex-row justify-between items-center gap-x-4\">
                <div class=\"w-full\">
                    <label for=\"admin-new-password\" class=\"underline\">New password</label>
                    <div class=\"relative\">
                        <input type=\"password\" id=\"admin-new-password\" name=\"password\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your new password...\" />
                        <i class=\"fa-solid fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 cursor-pointer\" onclick=\"togglePasswordVisibility('admin-new-password', this)\"></i>
                    </div>
                    <p id=\"profile-password-issue\" class=\"hidden text-red-700 font-semibold mt-2\"></p>
                </div>

                <div class=\"w-full\">
                    <label for=\"admin-confirm-password\" class=\"underline\">Confirm password</label>
                    <div class=\"relative\">
                        <input type=\"password\" id=\"admin-confirm-password\" name=\"password\" data-value=\"\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Confirm your new password...\" />
                        <i class=\"fa-solid fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 cursor-pointer\" onclick=\"togglePasswordVisibility('admin-confirm-password', this)\"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"mt-6 col-span-2\">
            <p class=\"text-2xl font-semibold mb-2\">
                Coordinates
            </p>

            <div class=\"flex flex-row justify-between items-center gap-x-4\">
                <div class=\"w-full\">
                    <label for=\"admin-address\" class=\"underline\">Address</label>
                    <input type=\"text\" id=\"admin-address\" data-value=\"{{ loggedAdmin.personalData.street }}\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your address...\" value=\"{{ loggedAdmin.personalData.street }}\" />
                </div>

                <div class=\"w-full\">
                    <label for=\"admin-city-code\" class=\"underline\">ZIP / Postal code</label>
                    <input type=\"text\" id=\"admin-city-code\" data-value=\"{{ loggedAdmin.personalData.postalCode }}\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your city code...\" value=\"{{ loggedAdmin.personalData.postalCode }}\" />
                </div>

                <div class=\"w-full\">
                    <label for=\"admin-city\" class=\"underline\">City name</label>
                    <input type=\"text\" id=\"admin-city\" data-value=\"{{ loggedAdmin.personalData.city }}\" class=\"w-full px-4 py-2 rounded-md text-stone-800 mt-2\" placeholder=\"Type in your city...\" value=\"{{ loggedAdmin.personalData.city }}\" />
                </div>
            </div>
        </div>

        {% include './components/profile/control_button.twig' %}
    </form>
</div>", "./home/zafkiel_admin_profile.twig", "C:\\wamp64\\www\\zafkiel\\src\\Presentation\\Templates\\home\\zafkiel_admin_profile.twig");
    }
}
