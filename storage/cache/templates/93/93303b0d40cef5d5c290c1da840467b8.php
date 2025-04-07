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

/* dashboard.twig */
class __TwigTemplate_b40340553dedef6f6c56fb3a4da4ebd9 extends Template
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

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.twig", "dashboard.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "\t";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
\t";
        // line 5
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("dashboard");
        yield "
";
        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 9
        yield "\t";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
\t";
        // line 10
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("dashboard");
        yield "
";
        yield from [];
    }

    // line 13
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 14
        yield "\tDashboard
";
        yield from [];
    }

    // line 17
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 18
        yield "\t<div class=\"dashboard\">
\t\t<div class=\"top-container mb-4 row g-0 rounded-4\">
\t\t\t<div class=\"col-8 border-end border-3\">
\t\t\t\t<div class=\"row justify-content-between\">
\t\t\t\t\t<div class=\"col p-4\">Expense \$</div>
\t\t\t\t\t<div class=\"col p-4\">Income \$</div>
\t\t\t\t\t<div class=\"col p-4\">Net \$</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col p-4\">Line/Bar/Donut Graph</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col p-4\">
\t\t\t\tLatest Transactions
\t\t\t</div>
\t\t</div>
\t\t<div class=\"categories-container row\">
\t\t\t<div class=\"col\">
\t\t\t\t<div class=\"category-card p-4 rounded-4\">Category 1</div>
\t\t\t</div>
\t\t\t<div class=\"col\">
\t\t\t\t<div class=\"category-card p-4 rounded-4\">Category 2</div>
\t\t\t</div>
\t\t\t<div class=\"col\">
\t\t\t\t<div class=\"category-card p-4 rounded-4\">Category 3</div>
\t\t\t</div>
\t\t\t<div class=\"col\">
\t\t\t\t<div class=\"category-card p-4 rounded-4\">Category 4</div>
\t\t\t</div>
\t\t</div>
\t</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "dashboard.twig";
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
        return array (  112 => 18,  105 => 17,  99 => 14,  92 => 13,  85 => 10,  80 => 9,  73 => 8,  66 => 5,  61 => 4,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "dashboard.twig", "/var/www/resources/views/dashboard.twig");
    }
}
