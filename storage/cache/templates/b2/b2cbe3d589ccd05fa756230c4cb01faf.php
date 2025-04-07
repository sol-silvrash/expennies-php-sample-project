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

/* auth/register.twig */
class __TwigTemplate_962cfc2f2042c170d29bdf2014d6bb1f extends Template
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
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "auth/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("auth/layout.twig", "auth/register.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Register
";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "\t<section class=\"vh-100 bg-primary bg-gradient\">
\t\t<div class=\"container py-5 h-100\">
\t\t\t<div class=\"row d-flex justify-content-center align-items-center h-100\">
\t\t\t\t<div class=\"col-12 col-md-8 col-lg-6 col-xl-5\">
\t\t\t\t\t<div class=\"card bg-light text-white\" style=\"border-radius: 1rem;\">
\t\t\t\t\t\t<div class=\"card-body p-5 text-center\">
\t\t\t\t\t\t\t<div class=\"mb-4\">
\t\t\t\t\t\t\t\t<h2 class=\"fw-bold mb-5 text-uppercase text-primary d-flex justify-content-center align-items-center\">
\t\t\t\t\t\t\t\t\t<img src=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/logo.png"), "html", null, true);
        yield "\" width=\"64\" height=\"64\" alt=\"Expennies Logo\"/>
\t\t\t\t\t\t\t\t\tRegister
\t\t\t\t\t\t\t\t</h2>
\t\t\t\t\t\t\t\t<form method=\"post\" action=\"/register\">
\t\t\t\t\t\t\t\t\t";
        // line 19
        yield CoreExtension::getAttribute($this->env, $this->source, ($context["csrf"] ?? null), "fields", [], "any", false, false, false, 19);
        yield "
\t\t\t\t\t\t\t\t\t<div class=\"form-outline form-white mb-4\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" value=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "name", [], "any", false, false, false, 21), "html", null, true);
        yield "\" name=\"name\" class=\"form-control form-control-lg ";
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", false, false, false, 21)) ? ("is-invalid") : (""));
        yield "\" placeholder=\"Name\" required/>
\t\t\t\t\t\t\t\t\t\t<div class=\"invalid-feedback\">
\t\t\t\t\t\t\t\t\t\t\t";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", false, false, false, 23)), "html", null, true);
        yield "
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-outline form-white mb-4\">
\t\t\t\t\t\t\t\t\t\t<input type=\"email\" value=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "email", [], "any", false, false, false, 27), "html", null, true);
        yield "\" name=\"email\" class=\"form-control form-control-lg ";
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", false, false, false, 27)) ? ("is-invalid") : (""));
        yield "\" placeholder=\"Email\" required/>
\t\t\t\t\t\t\t\t\t\t<div class=\"invalid-feedback\">
\t\t\t\t\t\t\t\t\t\t\t";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", false, false, false, 29)), "html", null, true);
        yield "
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-outline form-white mb-4\">
\t\t\t\t\t\t\t\t\t\t<input type=\"password\" name=\"password\" class=\"form-control form-control-lg ";
        // line 33
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", false, false, false, 33)) ? ("is-invalid") : (""));
        yield "\" placeholder=\"Password\" required/>
\t\t\t\t\t\t\t\t\t\t<div class=\"invalid-feedback\">
\t\t\t\t\t\t\t\t\t\t\t";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", false, false, false, 35)), "html", null, true);
        yield "
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"form-outline form-white mb-5\">
\t\t\t\t\t\t\t\t\t\t<input type=\"password\" name=\"confirmPassword\" class=\"form-control form-control-lg ";
        // line 39
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "confirmPassword", [], "any", false, false, false, 39)) ? ("is-invalid") : (""));
        yield "\" placeholder=\"Confirm Password\" required/>
\t\t\t\t\t\t\t\t\t\t<div class=\"invalid-feedback\">
\t\t\t\t\t\t\t\t\t\t\t";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "confirmPassword", [], "any", false, false, false, 41)), "html", null, true);
        yield "
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<button class=\"btn btn-primary bg-gradient text-white btn-lg px-5\" type=\"submit\">
\t\t\t\t\t\t\t\t\t\tRegister
\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t</form>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div>
\t\t\t\t\t\t\t\t<p class=\"mb-0 text-dark\">Have an account?
\t\t\t\t\t\t\t\t\t<a href=\"/login\" class=\"text-primary fw-bold\">Sign In</a>
\t\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "auth/register.twig";
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
        return array (  138 => 41,  133 => 39,  126 => 35,  121 => 33,  114 => 29,  107 => 27,  100 => 23,  93 => 21,  88 => 19,  81 => 15,  71 => 7,  64 => 6,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/register.twig", "/var/www/resources/views/auth/register.twig");
    }
}
