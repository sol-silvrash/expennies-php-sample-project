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

/* home/categories/edit_category_modal.twig */
class __TwigTemplate_a635166f344f70fda2d512d940c3c756 extends Template
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
        yield "<div class=\"modal fade\" id=\"editCategoryModal\" tabindex=\"-1\" aria-hidden=\"true\">
\t<div class=\"modal-dialog\">
\t\t<div class=\"modal-content\">
\t\t\t<div class=\"modal-header\">
\t\t\t\t<h5 class=\"modal-title\">Edit Category</h5>
\t\t\t\t<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
\t\t\t</div>
\t\t\t<div class=\"modal-body\">
\t\t\t\t<div class=\"mb-4\">
\t\t\t\t\t<input type=\"text\" name=\"name\" class=\"form-control form-control-lg\" placeholder=\"Category Name\">
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"modal-footer\">
\t\t\t\t<button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">
\t\t\t\t\t<i class=\"bi bi-x-circle me-1\"></i>
\t\t\t\t\tClose
\t\t\t\t</button>
\t\t\t\t<button type=\"button\" class=\"btn btn-success save-category-btn\">
\t\t\t\t\t<i class=\"bi bi-check-circle me-1\"></i>
\t\t\t\t\tSave
\t\t\t\t</button>
\t\t\t</div>
\t\t</div>
\t</div>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/categories/edit_category_modal.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "home/categories/edit_category_modal.twig", "/var/www/resources/views/home/categories/edit_category_modal.twig");
    }
}
