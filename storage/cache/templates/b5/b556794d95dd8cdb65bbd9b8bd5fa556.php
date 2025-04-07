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

/* categories/index.twig */
class __TwigTemplate_5320b6da16fa98f6b458d65c8f0d3417 extends Template
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
        $this->parent = $this->loadTemplate("layout.twig", "categories/index.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
";
        // line 5
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("categories");
        yield "
";
        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Categories
";
        yield from [];
    }

    // line 11
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 12
        yield "<div class=\"categories container content-body\">
\t<div class=\"text-end\">
\t\t<button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#newCategoryModal\">
\t\t\t<i class=\"bi bi-plus-circle me-1\"></i>
\t\t\tNew Category
\t\t</button>
\t</div>
\t<div class=\"modal fade\" id=\"newCategoryModal\" tabindex=\"-1\" aria-hidden=\"true\">
\t\t<div class=\"modal-dialog\">
\t\t\t<div class=\"modal-content\">
\t\t\t\t<div class=\"modal-header\">
\t\t\t\t\t<h5 class=\"modal-title\">New Category</h5>
\t\t\t\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
\t\t\t\t</div>
\t\t\t\t<div class=\"modal-body\">
\t\t\t\t\t<div class=\"mb-4\">
\t\t\t\t\t\t<input type=\"text\" name=\"name\" required class=\"form-control form-control-lg\"
\t\t\t\t\t\t\tplaceholder=\"Category Name\" />
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"modal-footer\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">
\t\t\t\t\t\t<i class=\"bi bi-x-circle me-1\"></i>
\t\t\t\t\t\tClose
\t\t\t\t\t</button>
\t\t\t\t\t<button type=\"button\" class=\"btn btn-success create-category-btn\">
\t\t\t\t\t\t<i class=\"bi bi-check-circle me-1\"></i>
\t\t\t\t\t\tCreate
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 45
        yield from $this->loadTemplate("categories/edit_category_modal.twig", "categories/index.twig", 45)->unwrap()->yield($context);
        // line 46
        yield "\t<div class=\"mt-5\">
\t\t<table id=\"categoriesTable\" class=\"table table-striped mt-3\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th>Name</th>
\t\t\t\t\t<th>Created At</th>
\t\t\t\t\t<th>Updated At</th>
\t\t\t\t\t<th>Actions</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody></tbody>
\t\t</table>
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
        return "categories/index.twig";
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
        return array (  127 => 46,  125 => 45,  90 => 12,  83 => 11,  71 => 8,  64 => 5,  60 => 4,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "categories/index.twig", "/var/www/resources/views/categories/index.twig");
    }
}
