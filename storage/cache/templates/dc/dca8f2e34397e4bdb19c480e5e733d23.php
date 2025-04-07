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

/* email/signup.html.twig */
class __TwigTemplate_fb99fcf8a14393a66145ff8411381c03 extends Template
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
        yield "Thank you for signing up to Expennies. Please <a href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["activateLink"] ?? null), "html", null, true);
        yield "\" target=\"_blank\">click here</a> to activate
your account.
<br />The link is valid until ";
        // line 3
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(($context["expirationDate"] ?? null), "m/d/Y g:i A"), "html", null, true);
        yield ".";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "email/signup.html.twig";
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
        return array (  48 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "email/signup.html.twig", "/var/www/resources/views/email/signup.html.twig");
    }
}
