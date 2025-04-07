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

/* layout.twig */
class __TwigTemplate_83da854d533cf443bd854fb7069ebaed extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
            'content' => [$this, 'block_content'],
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
        // line 11
        yield "\t\t</title>
\t\t<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\" />
\t\t<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin />
\t\t<link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap\"
\t\t\trel=\"stylesheet\" />
\t\t";
        // line 16
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 21
        yield "\t\t";
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 26
        yield "\t</head>

\t<body>
\t\t<div class=\"container\">
\t\t\t<header class=\"d-flex flex-wrap justify-content-center align-items-center py-3 mb-4\">
\t\t\t\t<a href=\"/\" class=\"d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none\">
\t\t\t\t\t<img src=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/logo.png"), "html", null, true);
        yield "\" width=\"64\" height=\"64\" alt=\"Expennies Logo\" />
\t\t\t\t\t<span class=\"fs-1 fw-bold\">Ex<span class=\"text-primary\">pennies</span>
\t\t\t\t\t</span>
\t\t\t\t</a>

\t\t\t\t<ul class=\"nav nav-pills align-items-center\">
\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t<a href=\"/\" class=\"nav-link fw-bold fs-5 active\" aria-current=\"page\">Overview</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t<a href=\"/transactions\" class=\"nav-link fw-bold fs-5\" aria-current=\"page\">Transactions</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t<a href=\"/categories\" class=\"nav-link fw-bold fs-5\" aria-current=\"page\">Categories</a>
\t\t\t\t\t</li>
\t\t\t\t</ul>

\t\t\t\t<div class=\"dropdown user-dropdown-menu\">
\t\t\t\t\t<button class=\"btn btn-outline-primary dropdown-toggle ms-4\" type=\"button\" id=\"dropdownMenu\"
\t\t\t\t\t\tdata-bs-toggle=\"dropdown\" aria-expanded=\"false\">
\t\t\t\t\t\t<i class=\"bi bi-person-circle h4\"></i>
\t\t\t\t\t\t<span class=\"ms-2\">
\t\t\t\t\t\t\t";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["auth"] ?? null), "name", [], "any", false, false, false, 54), "html", null, true);
        yield "
\t\t\t\t\t\t</span>
\t\t\t\t\t</button>
\t\t\t\t\t<form action=\"/logout\" method=\"post\">
\t\t\t\t\t\t";
        // line 58
        yield CoreExtension::getAttribute($this->env, $this->source, ($context["csrf"] ?? null), "fields", [], "any", false, false, false, 58);
        yield "
\t\t\t\t\t\t<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu\">
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<button class=\"dropdown-item\" href=\"#\" type=\"submit\">
\t\t\t\t\t\t\t\t\tLog Out
\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t</form>
\t\t\t\t</div>
\t\t\t</header>
\t\t</div>
\t\t<div class=\"container\"> ";
        // line 70
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 71
        yield "\t\t</div>
\t</body>

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
        yield "Expennies
\t\t\t";
        yield from [];
    }

    // line 16
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 17
        yield "\t\t";
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("app");
        // line 19
        yield "
\t\t";
        yield from [];
    }

    // line 21
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 22
        yield "\t\t";
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("app");
        // line 24
        yield "
\t\t";
        yield from [];
    }

    // line 70
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layout.twig";
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
        return array (  189 => 70,  183 => 24,  180 => 22,  173 => 21,  167 => 19,  164 => 17,  157 => 16,  145 => 9,  137 => 71,  135 => 70,  120 => 58,  113 => 54,  88 => 32,  80 => 26,  77 => 21,  75 => 16,  68 => 11,  66 => 9,  59 => 7,  53 => 6,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "layout.twig", "/var/www/resources/views/layout.twig");
    }
}
