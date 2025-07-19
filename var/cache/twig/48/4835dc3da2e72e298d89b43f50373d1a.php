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

/* home/Index.twig */
class __TwigTemplate_b134fbd20b6038ba8a9ce680289409d2 extends Template
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
  <head>
    <meta charset=\"UTF-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />

    <link rel=\"stylesheet\" href=\"/public/css/output.css\" />
    <link
      rel=\"stylesheet\"
      href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css\"
      integrity=\"sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==\"
      crossorigin=\"anonymous\"
      referrerpolicy=\"no-referrer\"
    />

    <title>Zafkiel backoffice</title>
  </head>
  <body class=\"relative\">

    <div class=\"absolute h-screen w-full\">
    ";
        // line 21
        if (((($_v0 = (($_v1 = (($_v2 = (($_v3 = ($context["adminData"] ?? null)) && is_array($_v3) || $_v3 instanceof ArrayAccess ? ($_v3["currentAdmin"] ?? null) : null)) && is_array($_v2) || $_v2 instanceof ArrayAccess ? ($_v2["additionnal_data"] ?? null) : null)) && is_array($_v1) || $_v1 instanceof ArrayAccess ? ($_v1["preferences"] ?? null) : null)) && is_array($_v0) || $_v0 instanceof ArrayAccess ? ($_v0["background"] ?? null) : null) == "slideshow")) {
            // line 22
            yield "        ";
            yield from $this->load("./components/slideshow/slideshow.html", 22)->unwrap()->yield(CoreExtension::merge($context, ["pref" => (($_v4 = (($_v5 = (($_v6 = (($_v7 = ($context["adminData"] ?? null)) && is_array($_v7) || $_v7 instanceof ArrayAccess ? ($_v7["currentAdmin"] ?? null) : null)) && is_array($_v6) || $_v6 instanceof ArrayAccess ? ($_v6["additionnal_data"] ?? null) : null)) && is_array($_v5) || $_v5 instanceof ArrayAccess ? ($_v5["preferences"] ?? null) : null)) && is_array($_v4) || $_v4 instanceof ArrayAccess ? ($_v4["backgroundPictures"] ?? null) : null)]));
            // line 23
            yield "    
    ";
        } else {
            // line 25
            yield "
      <img
        class=\"w-full h-56 object-cover\"
        src=\"";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v8 = (($_v9 = (($_v10 = (($_v11 = (($_v12 = ($context["adminData"] ?? null)) && is_array($_v12) || $_v12 instanceof ArrayAccess ? ($_v12["currentAdmin"] ?? null) : null)) && is_array($_v11) || $_v11 instanceof ArrayAccess ? ($_v11["additionnal_data"] ?? null) : null)) && is_array($_v10) || $_v10 instanceof ArrayAccess ? ($_v10["preferences"] ?? null) : null)) && is_array($_v9) || $_v9 instanceof ArrayAccess ? ($_v9["backgroundPictures"] ?? null) : null)) && is_array($_v8) || $_v8 instanceof ArrayAccess ? ($_v8[0] ?? null) : null), "html", null, true);
            yield "\"
        alt=\"backgroundPicture\"
      />

    ";
        }
        // line 33
        yield "    </div>

    <div
      class=\"flex flex-col justify-between items-center h-screen bg-cover bg-no-repeat\"
    >
      <main
        id=\"main-module\"
        class=\"module z-10 flex flex-row justify-between my-10 w-3/4 h-3/4 rounded-3xl backdrop-blur-sm bg-stone-800/[.6] text-gray-300\"
      >
\t\t<div class=\"flex flex-col justify-between items-center w-1/4 h-full py-6 bg-stone-900/[.7] rounded-l-3xl\">
\t\t\t<div
\t\t\tclass=\"relative text-xl w-full h-4/5 overflow-y-auto\"
\t\t\t>
\t\t\t\t<img
\t\t\t\t\tdata-profile-picture=\"currentAdmin\"
\t\t\t\t\tclass=\"block w-44 h-44 mx-auto rounded-full object-cover border-2 border-solid border-white\"
\t\t\t\t\tsrc=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v13 = (($_v14 = (($_v15 = ($context["adminData"] ?? null)) && is_array($_v15) || $_v15 instanceof ArrayAccess ? ($_v15["currentAdmin"] ?? null) : null)) && is_array($_v14) || $_v14 instanceof ArrayAccess ? ($_v14["additionnal_data"] ?? null) : null)) && is_array($_v13) || $_v13 instanceof ArrayAccess ? ($_v13["profile_picture"] ?? null) : null), "html", null, true);
        yield "\"
\t\t\t\t\talt=\"Photo de profil\"
\t\t\t\t/>

\t\t\t\t<div class=\"flex flex-col justify-between items-center w-full my-4\">
\t\t\t\t\t<ul class=\"list-none w-full\">
\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'desktop-tab');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-house\"></i>&nbsp;&nbsp;Desktop
\t\t\t\t\t</li>

\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'admin-settings');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-gear\"></i>&nbsp;&nbsp;
\t\t\t\t\t\tSettings
\t\t\t\t\t</li>

\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'admin-profile');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-user\"></i>&nbsp;&nbsp;
\t\t\t\t\t\tMy profile&nbsp;&nbsp;
\t\t\t\t\t\t<i id=\"warning-profile-icon\" class=\"fa-solid fa-triangle-exclamation color-[#F0B100]\" style=\"display: none;\"></i>
\t\t\t\t\t\t<span class=\"hidden\" id=\"alerts-number-profile\"></span>
\t\t\t\t\t</li>

\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'admins');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-user-lock\"></i>&nbsp;&nbsp;
\t\t\t\t\t\tAdministrators
\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"flex flex-row justify-evenly items-center gap-x-8 w-full h-1/5 mx-auto text-3xl\">

\t\t\t\t<div class=\"relative\">
\t\t\t\t\t<p class=\"absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] text-sm font-semibold\">9+</p>
\t\t\t\t\t<i class=\"fa-regular fa-bell text-5xl\"></i>
\t\t\t\t</div>
\t
\t\t\t\t<div class=\"flex flex-col justify-center items-center\">
\t\t\t\t\t<div id=\"zafkiel-taskbar-clock\" class=\"text-sm\"></div>
\t\t\t\t\t<div id=\"zafkiel-taskbar-date\" class=\"text-sm\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>

        <div id=\"desktop-tab\" class=\"module-tab-content w-3/4\">
          <form
            action=\"#\"
            method=\"POST\"
            class=\"w-full\"
            onsubmit=\"displayResults(event);\"
          >
            <div class=\"relative w-2/4 mx-auto my-8\">
              <input
                type=\"search\"
                list=\"services-list\"
                id=\"search-service\"
                name=\"search-service\"
                placeholder=\"Search for a service...\"
                class=\"absolute left-1/2 translate-x-[-50%] w-full rounded-xl px-4 py-2 bg-stone-800\"
                onkeyup=\"displayResults(event)\"
              />

              <button class=\"absolute right-3 translate-y-1/3\" type=\"submit\">
                <i class=\"fa-solid fa-magnifying-glass\"></i>
              </button>
            </div>

            <datalist id=\"services-list\">
              ";
        // line 129
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((($_v16 = (($_v17 = ($context["components"] ?? null)) && is_array($_v17) || $_v17 instanceof ArrayAccess ? ($_v17["modules"] ?? null) : null)) && is_array($_v16) || $_v16 instanceof ArrayAccess ? ($_v16["items"] ?? null) : null));
        foreach ($context['_seq'] as $context["module"] => $context["key"]) {
            // line 130
            yield "
              <option
                value=\"";
            // line 132
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["module"], "html", null, true);
            yield "\"
                data-path=\"";
            // line 133
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v18 = (($_v19 = ($context["components"] ?? null)) && is_array($_v19) || $_v19 instanceof ArrayAccess ? ($_v19["modules"] ?? null) : null)) && is_array($_v18) || $_v18 instanceof ArrayAccess ? ($_v18["moduleIconsPath"] ?? null) : null), "html", null, true);
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v20 = $context["key"]) && is_array($_v20) || $_v20 instanceof ArrayAccess ? ($_v20["path"] ?? null) : null), "html", null, true);
            yield "\"
              >
                ";
            // line 135
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v21 = $context["key"]) && is_array($_v21) || $_v21 instanceof ArrayAccess ? ($_v21["name"] ?? null) : null), "html", null, true);
            yield "
              </option>

              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['module'], $context['key'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 139
        yield "            </datalist>
          </form>

          <div class=\"w-4/5 mx-auto mt-28 mb-6\">
            <p class=\"w-full font-semibold text-2xl\">My services</p>
          </div>

          <div
            id=\"services-container\"
            class=\"grid grid-cols-3 gap-x-6 w-4/5 h-3/5 mx-auto overflow-y-auto\"
          >
            ";
        // line 150
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((($_v22 = (($_v23 = ($context["components"] ?? null)) && is_array($_v23) || $_v23 instanceof ArrayAccess ? ($_v23["modules"] ?? null) : null)) && is_array($_v22) || $_v22 instanceof ArrayAccess ? ($_v22["items"] ?? null) : null));
        foreach ($context['_seq'] as $context["key"] => $context["module"]) {
            // line 151
            yield "
            <div
              class=\"w-44 h-44 p-2 hover:bg-gray-400/[.5] hover:cursor-pointer\"
              onclick=\"openService(event, '";
            // line 154
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "');\"
            >
              <img
                class=\"block w-28 h-28 mx-auto rounded-full\"
                src=\"";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v24 = (($_v25 = ($context["components"] ?? null)) && is_array($_v25) || $_v25 instanceof ArrayAccess ? ($_v25["modules"] ?? null) : null)) && is_array($_v24) || $_v24 instanceof ArrayAccess ? ($_v24["moduleIconsPath"] ?? null) : null), "html", null, true);
            yield "/";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v26 = $context["module"]) && is_array($_v26) || $_v26 instanceof ArrayAccess ? ($_v26["path"] ?? null) : null), "html", null, true);
            yield "\"
                alt=\"Icon for service: ";
            // line 159
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v27 = $context["module"]) && is_array($_v27) || $_v27 instanceof ArrayAccess ? ($_v27["name"] ?? null) : null), "html", null, true);
            yield "\"
              />

              <p class=\"font-semibold text-center mt-2 text-lg\">
                ";
            // line 163
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v28 = $context["module"]) && is_array($_v28) || $_v28 instanceof ArrayAccess ? ($_v28["name"] ?? null) : null), "html", null, true);
            yield "
              </p>
            </div>

            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['module'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 168
        yield "          </div>
        </div>

        ";
        // line 171
        yield from $this->load("./zafkiel_administrators_template.html", 171)->unwrap()->yield(CoreExtension::merge($context, ["data" => ($context["adminData"] ?? null)]));
        // line 172
        yield "        ";
        yield from $this->load("./zafkiel_administrator_profile_template.html", 172)->unwrap()->yield(CoreExtension::merge($context, ["data" => ($context["adminData"] ?? null)]));
        // line 173
        yield "        ";
        yield from $this->load("./zafkiel_administrator_settings_template.html", 173)->unwrap()->yield(CoreExtension::merge($context, ["data" => ($context["adminData"] ?? null)]));
        // line 175
        yield "      </main>

      ";
        // line 177
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["templates"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["template"]) {
            yield " ";
            yield $context["template"];
            yield " ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['template'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 178
        yield "
      <footer
        class=\"flex flex-row justify-evenly items-center w-full gap-x-6 h-16 backdrop-blur-sm bg-stone-800/[.8] text-gray-300 z-10\"
      >
        <div
          class=\"flex flex-row justify-start items-center gap-x-6 w-4/5 h-full mx-auto text-3xl\"
        >
          <img
            class=\"w-auto h-full p-2 hover:bg-gray-400/[.4]\"
            src=\"/public/img/zafkiel/zafkiel_logo.png\"
            alt=\"Zafkiel logo.\"
          />

          <div
            class=\"flex flex-row items-center gap-x-0.5 h-full border-x-2 border-solid px-6\"
          >
            <i
              class=\"fa-solid fa-power-off items-center h-full p-4 hover:bg-gray-400/[.4]\"
              style=\"display: flex\"
            ></i>
            <i
              class=\"fa-solid fa-user items-center h-full p-4 hover:bg-gray-400/[.4]\"
              style=\"display: flex\"
            ></i>
            <i
              class=\"fa-solid fa-arrow-right-arrow-left items-center h-full p-4 hover:bg-gray-400/[.4]\"
              style=\"display: flex\"
            ></i>
          </div>

          <div class=\"flex flex-row justify-start items-start gap-x-0.5\">
            ";
        // line 209
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((($_v29 = (($_v30 = ($context["components"] ?? null)) && is_array($_v30) || $_v30 instanceof ArrayAccess ? ($_v30["modules"] ?? null) : null)) && is_array($_v29) || $_v29 instanceof ArrayAccess ? ($_v29["items"] ?? null) : null));
        foreach ($context['_seq'] as $context["key"] => $context["module"]) {
            // line 210
            yield "              ";
            if ((($tmp = (($_v31 = $context["module"]) && is_array($_v31) || $_v31 instanceof ArrayAccess ? ($_v31["pinned"] ?? null) : null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 211
                yield "
            <div
              class=\"p-2 hover:bg-gray-400/[.4]\"
              onclick=\"openService(event, '";
                // line 214
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
                yield "')\"
            >
              <img
                class=\"w-12 h-12\"
                src=\"";
                // line 218
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v32 = (($_v33 = ($context["components"] ?? null)) && is_array($_v33) || $_v33 instanceof ArrayAccess ? ($_v33["modules"] ?? null) : null)) && is_array($_v32) || $_v32 instanceof ArrayAccess ? ($_v32["moduleIconsPath"] ?? null) : null), "html", null, true);
                yield "/";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v34 = $context["module"]) && is_array($_v34) || $_v34 instanceof ArrayAccess ? ($_v34["path"] ?? null) : null), "html", null, true);
                yield "\"
                alt=\"Icon for service : ";
                // line 219
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($_v35 = $context["module"]) && is_array($_v35) || $_v35 instanceof ArrayAccess ? ($_v35["name"] ?? null) : null), "html", null, true);
                yield "\"
              />
            </div>

              ";
            }
            // line 224
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['module'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 225
        yield "          </div>
        </div>
      </footer>
    </div>

    <div id=\"snackbar-container\" class=\"flex flex-col fixed bottom-10 left-1/2 translate-x-[-50%] max-w-screen-sm bg-transparent z-10\"></div>

    <script>
      window.onload = (evt) => {
        localStorage.setItem('jwtToken', '";
        // line 234
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["jwtToken"] ?? null), "html", null, true);
        yield "');
      }
    </script>
    <script src=\"public/js/zafkiel/frontend_interactions.js\"></script>
    <script src=\"public/js/zafkiel/slideshow.conf.js\"></script>
    <script src=\"public/js/zafkiel/admin_profile.conf.js\"></script>
    <script src=\"public/js/zafkiel/ZafkielSnackbar.js\"></script>
  </body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/Index.twig";
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
        return array (  380 => 234,  369 => 225,  363 => 224,  355 => 219,  349 => 218,  342 => 214,  337 => 211,  334 => 210,  330 => 209,  297 => 178,  286 => 177,  282 => 175,  279 => 173,  276 => 172,  274 => 171,  269 => 168,  258 => 163,  251 => 159,  245 => 158,  238 => 154,  233 => 151,  229 => 150,  216 => 139,  206 => 135,  199 => 133,  195 => 132,  191 => 130,  187 => 129,  104 => 49,  86 => 33,  78 => 28,  73 => 25,  69 => 23,  66 => 22,  64 => 21,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
  <head>
    <meta charset=\"UTF-8\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />

    <link rel=\"stylesheet\" href=\"/public/css/output.css\" />
    <link
      rel=\"stylesheet\"
      href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css\"
      integrity=\"sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==\"
      crossorigin=\"anonymous\"
      referrerpolicy=\"no-referrer\"
    />

    <title>Zafkiel backoffice</title>
  </head>
  <body class=\"relative\">

    <div class=\"absolute h-screen w-full\">
    {% if adminData['currentAdmin']['additionnal_data']['preferences']['background'] == 'slideshow' %}
        {% include './components/slideshow/slideshow.html' with {pref: adminData['currentAdmin']['additionnal_data']['preferences']['backgroundPictures']} %}
    
    {% else %}

      <img
        class=\"w-full h-56 object-cover\"
        src=\"{{ adminData['currentAdmin']['additionnal_data']['preferences']['backgroundPictures'][0] }}\"
        alt=\"backgroundPicture\"
      />

    {% endif %}
    </div>

    <div
      class=\"flex flex-col justify-between items-center h-screen bg-cover bg-no-repeat\"
    >
      <main
        id=\"main-module\"
        class=\"module z-10 flex flex-row justify-between my-10 w-3/4 h-3/4 rounded-3xl backdrop-blur-sm bg-stone-800/[.6] text-gray-300\"
      >
\t\t<div class=\"flex flex-col justify-between items-center w-1/4 h-full py-6 bg-stone-900/[.7] rounded-l-3xl\">
\t\t\t<div
\t\t\tclass=\"relative text-xl w-full h-4/5 overflow-y-auto\"
\t\t\t>
\t\t\t\t<img
\t\t\t\t\tdata-profile-picture=\"currentAdmin\"
\t\t\t\t\tclass=\"block w-44 h-44 mx-auto rounded-full object-cover border-2 border-solid border-white\"
\t\t\t\t\tsrc=\"{{ adminData['currentAdmin']['additionnal_data']['profile_picture'] }}\"
\t\t\t\t\talt=\"Photo de profil\"
\t\t\t\t/>

\t\t\t\t<div class=\"flex flex-col justify-between items-center w-full my-4\">
\t\t\t\t\t<ul class=\"list-none w-full\">
\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'desktop-tab');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-house\"></i>&nbsp;&nbsp;Desktop
\t\t\t\t\t</li>

\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'admin-settings');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-gear\"></i>&nbsp;&nbsp;
\t\t\t\t\t\tSettings
\t\t\t\t\t</li>

\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'admin-profile');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-user\"></i>&nbsp;&nbsp;
\t\t\t\t\t\tMy profile&nbsp;&nbsp;
\t\t\t\t\t\t<i id=\"warning-profile-icon\" class=\"fa-solid fa-triangle-exclamation color-[#F0B100]\" style=\"display: none;\"></i>
\t\t\t\t\t\t<span class=\"hidden\" id=\"alerts-number-profile\"></span>
\t\t\t\t\t</li>

\t\t\t\t\t<li
\t\t\t\t\t\tonclick=\"displayTab(event, 'module', 'admins');\"
\t\t\t\t\t\tclass=\"hover:cursor-pointer hover:bg-gray-200/[.4] px-8 py-4\"
\t\t\t\t\t>
\t\t\t\t\t\t<i class=\"fa-solid fa-user-lock\"></i>&nbsp;&nbsp;
\t\t\t\t\t\tAdministrators
\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"flex flex-row justify-evenly items-center gap-x-8 w-full h-1/5 mx-auto text-3xl\">

\t\t\t\t<div class=\"relative\">
\t\t\t\t\t<p class=\"absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] text-sm font-semibold\">9+</p>
\t\t\t\t\t<i class=\"fa-regular fa-bell text-5xl\"></i>
\t\t\t\t</div>
\t
\t\t\t\t<div class=\"flex flex-col justify-center items-center\">
\t\t\t\t\t<div id=\"zafkiel-taskbar-clock\" class=\"text-sm\"></div>
\t\t\t\t\t<div id=\"zafkiel-taskbar-date\" class=\"text-sm\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>

        <div id=\"desktop-tab\" class=\"module-tab-content w-3/4\">
          <form
            action=\"#\"
            method=\"POST\"
            class=\"w-full\"
            onsubmit=\"displayResults(event);\"
          >
            <div class=\"relative w-2/4 mx-auto my-8\">
              <input
                type=\"search\"
                list=\"services-list\"
                id=\"search-service\"
                name=\"search-service\"
                placeholder=\"Search for a service...\"
                class=\"absolute left-1/2 translate-x-[-50%] w-full rounded-xl px-4 py-2 bg-stone-800\"
                onkeyup=\"displayResults(event)\"
              />

              <button class=\"absolute right-3 translate-y-1/3\" type=\"submit\">
                <i class=\"fa-solid fa-magnifying-glass\"></i>
              </button>
            </div>

            <datalist id=\"services-list\">
              {% for module, key in components['modules']['items'] %}

              <option
                value=\"{{ module }}\"
                data-path=\"{{ components['modules']['moduleIconsPath'] }}/{{ key['path']}}\"
              >
                {{ key['name'] }}
              </option>

              {% endfor %}
            </datalist>
          </form>

          <div class=\"w-4/5 mx-auto mt-28 mb-6\">
            <p class=\"w-full font-semibold text-2xl\">My services</p>
          </div>

          <div
            id=\"services-container\"
            class=\"grid grid-cols-3 gap-x-6 w-4/5 h-3/5 mx-auto overflow-y-auto\"
          >
            {% for key, module in components['modules']['items'] %}

            <div
              class=\"w-44 h-44 p-2 hover:bg-gray-400/[.5] hover:cursor-pointer\"
              onclick=\"openService(event, '{{ key }}');\"
            >
              <img
                class=\"block w-28 h-28 mx-auto rounded-full\"
                src=\"{{ components['modules']['moduleIconsPath'] }}/{{ module['path'] }}\"
                alt=\"Icon for service: {{ module['name'] }}\"
              />

              <p class=\"font-semibold text-center mt-2 text-lg\">
                {{ module['name'] }}
              </p>
            </div>

            {% endfor %}
          </div>
        </div>

        {% include './zafkiel_administrators_template.html' with {data: adminData} %}
        {% include './zafkiel_administrator_profile_template.html' with {data: adminData} %}
        {% include './zafkiel_administrator_settings_template.html' with {data: adminData}
        %}
      </main>

      {% for template in templates %} {{ template|raw }} {% endfor %}

      <footer
        class=\"flex flex-row justify-evenly items-center w-full gap-x-6 h-16 backdrop-blur-sm bg-stone-800/[.8] text-gray-300 z-10\"
      >
        <div
          class=\"flex flex-row justify-start items-center gap-x-6 w-4/5 h-full mx-auto text-3xl\"
        >
          <img
            class=\"w-auto h-full p-2 hover:bg-gray-400/[.4]\"
            src=\"/public/img/zafkiel/zafkiel_logo.png\"
            alt=\"Zafkiel logo.\"
          />

          <div
            class=\"flex flex-row items-center gap-x-0.5 h-full border-x-2 border-solid px-6\"
          >
            <i
              class=\"fa-solid fa-power-off items-center h-full p-4 hover:bg-gray-400/[.4]\"
              style=\"display: flex\"
            ></i>
            <i
              class=\"fa-solid fa-user items-center h-full p-4 hover:bg-gray-400/[.4]\"
              style=\"display: flex\"
            ></i>
            <i
              class=\"fa-solid fa-arrow-right-arrow-left items-center h-full p-4 hover:bg-gray-400/[.4]\"
              style=\"display: flex\"
            ></i>
          </div>

          <div class=\"flex flex-row justify-start items-start gap-x-0.5\">
            {% for key, module in components['modules']['items'] %}
              {% if module['pinned'] %}

            <div
              class=\"p-2 hover:bg-gray-400/[.4]\"
              onclick=\"openService(event, '{{ key }}')\"
            >
              <img
                class=\"w-12 h-12\"
                src=\"{{ components['modules']['moduleIconsPath'] }}/{{ module['path'] }}\"
                alt=\"Icon for service : {{ module['name'] }}\"
              />
            </div>

              {% endif %}
            {% endfor %}
          </div>
        </div>
      </footer>
    </div>

    <div id=\"snackbar-container\" class=\"flex flex-col fixed bottom-10 left-1/2 translate-x-[-50%] max-w-screen-sm bg-transparent z-10\"></div>

    <script>
      window.onload = (evt) => {
        localStorage.setItem('jwtToken', '{{ jwtToken }}');
      }
    </script>
    <script src=\"public/js/zafkiel/frontend_interactions.js\"></script>
    <script src=\"public/js/zafkiel/slideshow.conf.js\"></script>
    <script src=\"public/js/zafkiel/admin_profile.conf.js\"></script>
    <script src=\"public/js/zafkiel/ZafkielSnackbar.js\"></script>
  </body>
</html>
", "home/Index.twig", "C:\\wamp64\\www\\zafkiel\\src\\Presentation\\Templates\\home\\Index.twig");
    }
}
