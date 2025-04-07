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

/* auth/forgot.password.twig */
class __TwigTemplate_11b470889f7a5787c1f40c11dfa931ad extends Template
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
        return "auth/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("auth/layout.twig", "auth/forgot.password.twig", 1);
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
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
";
        // line 5
        yield $this->env->getFunction('encore_entry_link_tags')->getCallable()("forgot_password");
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
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
";
        // line 10
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("forgot_password");
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
        yield "Forgot Password";
        yield from [];
    }

    // line 15
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 16
        yield "<section class=\"vh-100 bg-primary bg-gradient\">
    <div class=\"container py-5 h-100\">
        <div class=\"row d-flex justify-content-center align-items-center h-100\">
            <div class=\"col-12 col-md-8 col-lg-6 col-xl-5\">
                <div class=\"card bg-light text-white\" style=\"border-radius: 1rem;\">
                    <div class=\"card-body p-5 text-center\">
                        <div class=\"mb-4\">
                            <h2
                                class=\"fw-bold mb-4 text-uppercase text-primary d-flex justify-content-center align-items-center\">
                                <img src=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("build/images/logo.png"), "html", null, true);
        yield "\" width=\"64\" height=\"64\"
                                    alt=\"Expennies Logo\" /> Forgot Password
                            </h2>
                            <div class=\"forgot-password-form\">
                                <div class=\"form-outline mb-4\">
                                    <input type=\"email\" name=\"email\" class=\"form-control form-control-lg\"
                                        placeholder=\"Enter your email address\" required />
                                </div>
                                <button class=\"btn btn-primary bg-gradient text-white btn-lg px-5 forgot-password-btn\"
                                    type=\"button\">
                                    Continue
                                </button>
                            </div>
                        </div>
                        <div>
                            <p class=\"mb-0 text-dark\">
                                Back to <a href=\"/login\" class=\"text-primary fw-bold\">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "auth/forgot.password.twig";
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
        return array (  119 => 25,  108 => 16,  101 => 15,  90 => 13,  83 => 10,  79 => 9,  72 => 8,  65 => 5,  61 => 4,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "auth/forgot.password.twig", "/var/www/resources/views/auth/forgot.password.twig");
    }
}
