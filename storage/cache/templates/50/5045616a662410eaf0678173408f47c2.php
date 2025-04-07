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

/* auth/layout.twig */
class __TwigTemplate_d1ee6a4eef4c6e61d52e053405458013 extends Template
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
\t\t<meta charset=\"UTF-8\">
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
\t\t<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
\t\t<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
\t\t<link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap\"
\t\t\trel=\"stylesheet\">

\t\t";
        // line 16
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 19
        yield "\t</head>

\t<body>
\t\t";
        // line 22
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 23
        yield "\t</body>

\t";
        // line 25
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 28
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
        yield "Expennies Auth";
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
        yield "
\t\t";
        yield from [];
    }

    // line 22
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 25
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 26
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
        return "auth/layout.twig";
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
        return array (  140 => 26,  133 => 25,  123 => 22,  115 => 17,  108 => 16,  97 => 9,  91 => 28,  89 => 25,  85 => 23,  83 => 22,  78 => 19,  76 => 16,  68 => 10,  66 => 9,  59 => 7,  53 => 6,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/layout.twig", "/var/www/resources/views/auth/layout.twig");
    }
}
