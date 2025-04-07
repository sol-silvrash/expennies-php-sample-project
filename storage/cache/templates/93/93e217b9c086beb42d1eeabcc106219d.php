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

/* home/transactions/transaction.modal.twig */
class __TwigTemplate_1d544df799a5f535f5e9e1217c3cdaed extends Template
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
        yield "<div class=\"modal fade\" id=\"transaction-modal\" tabindex=\"-1\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title form-title\"></h5>
            </div>
            <div class=\"modal-body\">
                <div class=\"mb-4\">
                    <label for=\"description\" class=\"form-label small fw-bold\">Description</label>
                    <input type=\"text\" class=\"form-control\" name=\"description\" id=\"description\"
                        placeholder=\"Enter Description\">
                </div>
                <div class=\"mb-4\">
                    <label for=\"description\" class=\"form-label small fw-bold\">Date</label>
                    <input type=\"datetime-local\" class=\"form-control\" name=\"date\" id=\"date\" placeholder=\"Enter Date\">
                </div>
                <div class=\"mb-4\">
                    <label for=\"amount\" class=\"form-label small fw-bold\">Amount</label>
                    <input type=\"text\" class=\"form-control\" name=\"amount\" id=\"amount\" placeholder=\"₱ Amount\">
                </div>
                <div class=\"mb-4\">
                    <label for=\"category\" class=\"form-label small fw-bold\">Categories</label>
                    <select name=\"category\" class=\"form-control\" id=\"category\">
                        <option value=\"\" disabled selected>Select Category</option>
                        ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["categoryItem"]) {
            // line 26
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categoryItem"], "id", [], "any", false, false, false, 26), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categoryItem"], "name", [], "any", false, false, false, 26), "html", null, true);
            yield "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['categoryItem'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        yield "                    </select>
                </div>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">
                    <i class=\"bi bi-x-circle me-1\"></i>
                    Close
                </button>
                <button type=\"submit\" class=\"btn btn-success save-transaction-btn\">
                    <i class=\"bi bi-check-circle me-1\"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/transactions/transaction.modal.twig";
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
        return array (  83 => 28,  72 => 26,  68 => 25,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "home/transactions/transaction.modal.twig", "/var/www/resources/views/home/transactions/transaction.modal.twig");
    }
}
