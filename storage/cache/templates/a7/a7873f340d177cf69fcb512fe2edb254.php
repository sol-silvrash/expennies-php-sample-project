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
class __TwigTemplate_2a004098656943d342ddb4c3cf7714ff extends Template
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
\t\t<title>
\t\t\t";
        // line 5
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 7
        yield "\t\t</title>
\t\t<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
\t\t<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
\t\t<link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap\" rel=\"stylesheet\">

\t\t";
        // line 12
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 16
        yield "
\t\t";
        // line 17
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 21
        yield "\t</head>
\t<body>
\t\t";
        // line 23
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 24
        yield "\t</body>
</html>
";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Expennies Auth
\t\t\t";
        yield from [];
    }

    // line 12
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 13
        yield "\t\t\t";
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("app");
        yield "
\t\t\t";
        // line 14
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("auth");
        yield "
\t\t";
        yield from [];
    }

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 18
        yield "\t\t\t";
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("app");
        yield "
\t\t\t";
        // line 19
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("auth");
        yield "
\t\t";
        yield from [];
    }

    // line 23
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
        return "auth/layout.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  131 => 23,  124 => 19,  119 => 18,  112 => 17,  105 => 14,  100 => 13,  93 => 12,  81 => 5,  74 => 24,  72 => 23,  68 => 21,  66 => 17,  63 => 16,  61 => 12,  54 => 7,  52 => 5,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/layout.twig", "/var/www/resources/views/auth/layout.twig");
    }
}
