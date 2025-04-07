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

/* home/profile/profile.twig */
class __TwigTemplate_7d0cac278df92b5da7cbaff56d9bd825 extends Template
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
        return "home/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("home/layout.twig", "home/profile/profile.twig", 1);
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
        yield $this->env->getFunction('encore_entry_script_tags')->getCallable()("profile");
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
        yield "Profile
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
    <h1>Profile</h1>
    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-4\">
                <label for=\"email\" class=\"form-label fw-bold\">Email</label>
            </div>
            <div class=\"col\">
                <label for=\"name\" class=\"form-label fw-bold\">Name</label>
            </div>
        </div>
        <div class=\"row align-items-center\">
            <div class=\"col\">
                <input type=\"email\" class=\"form-control\" id=\"email\" value=\"";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["email"] ?? null), "html", null, true);
        yield "\" disabled>
            </div>
            <div class=\"col\">
                <input type=\"text\" class=\"form-control\" id=\"name\" value=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["name"] ?? null), "html", null, true);
        yield "\">
            </div>
            <div class=\"col\">
                <input class=\"form-check-input\" type=\"checkbox\" id=\"tfaCheck\" value=\"1\" ";
        // line 31
        yield ((($context["tfa"] ?? null)) ? ("checked") : (""));
        yield ">
                <label class=\"form-check-label ms-2\" for=\"tfaCheck\">
                    Enable 2FA via Email
                </label>
            </div>
        </div>
        <div class=\"row mt-3\">
            <div class=\"col-4 offset-4\">
                <div class=\"row\">
                    <div class=\"col\">
                        <button class=\"btn btn-outline-primary w-100\" data-bs-toggle=\"modal\"
                            data-bs-target=\"#changePasswordModal\">
                            <span class=\"bi bi-key-fill me-2\"></span>
                            Update Password
                        </button>
                    </div>
                    <div class=\"col\">
                        <button class=\"btn btn-success w-100\" id=\"saveChanges\">
                            <span class=\"bi bi-check-circle me-2\"></span>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
        // line 58
        yield from $this->loadTemplate("home/profile/password.modal.profile.twig", "home/profile/profile.twig", 58)->unwrap()->yield($context);
        // line 59
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/profile/profile.twig";
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
        return array (  149 => 59,  147 => 58,  117 => 31,  111 => 28,  105 => 25,  90 => 12,  83 => 11,  71 => 8,  64 => 5,  60 => 4,  53 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "home/profile/profile.twig", "/var/www/resources/views/home/profile/profile.twig");
    }
}
