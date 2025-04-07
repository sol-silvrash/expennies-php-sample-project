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

/* home/layout.twig */
class __TwigTemplate_9642613835e35b6e8451b8a6a50fe601 extends Template
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
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" class=\"h-full bg-gray-100\">

\t<head>
\t\t<meta charset=\"UTF-8\" />
\t\t<meta id=\"csrfName\" name=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["csrf"] ?? null), "keys", [], "any", false, false, false, 6), "name", [], "any", false, false, false, 6), "html", null, true);
        yield "\" content=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["csrf"] ?? null), "name", [], "any", false, false, false, 6), "html", null, true);
        yield "\">
\t\t<meta id=\"csrfValue\" name=\"";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["csrf"] ?? null), "keys", [], "any", false, false, false, 7), "value", [], "any", false, false, false, 7), "html", null, true);
        yield "\" content=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["csrf"] ?? null), "value", [], "any", false, false, false, 7), "html", null, true);
        yield "\">
\t\t<title>
\t\t\t";
        // line 9
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 10
        yield "\t\t</title>
\t\t<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\" />
\t\t<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin />
\t\t<link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap\"
\t\t\trel=\"stylesheet\" />
\t\t";
        // line 15
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 18
        yield "\t</head>

\t<body>
\t\t<div class=\"container\">
\t\t\t<header class=\"d-flex flex-wrap justify-content-center align-items-center py-3 mb-4\">
\t\t\t\t<a href=\"/\" class=\"d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none\">
\t\t\t\t\t<img src=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/logo.png"), "html", null, true);
        yield "\" width=\"64\" height=\"64\" alt=\"Expennies Logo\" />
\t\t\t\t\t<span class=\"fs-1 fw-bold\">Ex<span class=\"text-primary\">pennies</span>
\t\t\t\t\t</span>
\t\t\t\t</a>

\t\t\t\t<ul class=\"nav nav-pills align-items-center\">
\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t<a href=\"/\" class=\"nav-link fw-bold fs-5 ";
        // line 31
        yield (((($context["current_route"] ?? null) == "home")) ? ("active") : (""));
        yield "\"
\t\t\t\t\t\t\taria-current=\"page\">Overview</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t<a href=\"/transactions\"
\t\t\t\t\t\t\tclass=\"nav-link fw-bold fs-5 ";
        // line 36
        yield (((($context["current_route"] ?? null) == "transactions")) ? ("active") : (""));
        yield "\"
\t\t\t\t\t\t\taria-current=\"page\">Transaction</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t<a href=\"/categories\"
\t\t\t\t\t\t\tclass=\"nav-link fw-bold fs-5 ";
        // line 41
        yield (((($context["current_route"] ?? null) == "categories")) ? ("active") : (""));
        yield "\"
\t\t\t\t\t\t\taria-current=\"page\">Category</a>
\t\t\t\t\t</li>
\t\t\t\t</ul>

\t\t\t\t<div class=\"dropdown user-dropdown-menu\">
\t\t\t\t\t<button class=\"btn btn-outline-primary dropdown-toggle ms-4\" type=\"button\" id=\"dropdownMenu\"
\t\t\t\t\t\tdata-bs-toggle=\"dropdown\" aria-expanded=\"false\">
\t\t\t\t\t\t<i class=\"bi bi-person-circle h4\"></i>
\t\t\t\t\t\t<span class=\"ms-2\">
\t\t\t\t\t\t\t";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["auth"] ?? null), "name", [], "any", false, false, false, 51), "html", null, true);
        yield "
\t\t\t\t\t\t</span>
\t\t\t\t\t</button>
\t\t\t\t\t<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu\">
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a class=\"dropdown-item\" href=\"/profile\">
\t\t\t\t\t\t\t\tProfile
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<hr class=\"dropdown-divider\" />
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<form action=\"/logout\" method=\"post\">
\t\t\t\t\t\t\t";
        // line 64
        yield CoreExtension::getAttribute($this->env, $this->source, ($context["csrf"] ?? null), "fields", [], "any", false, false, false, 64);
        yield "
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<button class=\"dropdown-item\" type=\"submit\">
\t\t\t\t\t\t\t\t\tLog Out
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t</form>
\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t</header>
\t\t</div>
\t\t<div class=\"container\"> ";
        // line 75
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 76
        yield "\t\t</div>
\t</body>
\t";
        // line 78
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 81
        yield "
</html>";
        yield from [];
    }

    // line 9
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Expennies";
        yield from [];
    }

    // line 15
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 16
        yield "\t\t";
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("app");
        yield "
\t\t";
        yield from [];
    }

    // line 75
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 78
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 79
        yield "\t";
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("app");
        yield "
\t";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/layout.twig";
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
        return array (  211 => 79,  204 => 78,  194 => 75,  186 => 16,  179 => 15,  168 => 9,  162 => 81,  160 => 78,  156 => 76,  154 => 75,  140 => 64,  124 => 51,  111 => 41,  103 => 36,  95 => 31,  85 => 24,  77 => 18,  75 => 15,  68 => 10,  66 => 9,  59 => 7,  53 => 6,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "home/layout.twig", "/var/www/resources/views/home/layout.twig");
    }
}
