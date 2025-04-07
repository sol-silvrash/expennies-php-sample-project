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

/* home/profile/password.modal.profile.twig */
class __TwigTemplate_d7c54782876baa1df51c516fa4bc6da2 extends Template
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
        yield "<div class=\"modal fade\" id=\"changePasswordModal\" tabindex=\"-1\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\">Update Password</h5>
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
            </div>
            <div class=\"modal-body\">
                <div class=\"mb-4\">
                    <label for=\"currentPassword\" class=\"fw-bold\">
                        Current Password
                    </label>
                    <input type=\"password\" name=\"currentPassword\" id=\"currentPassword\" class=\"form-control mt-2\"
                        placeholder=\"Current Password\">
                </div>
                <div class=\"mb-4\">
                    <label for=\"newPassword\" class=\"fw-bold\">
                        New Password
                    </label>
                    <input type=\"password\" name=\"newPassword\" id=\"newPassword\" class=\"form-control mt-2\"
                        placeholder=\"New Password\">
                </div>
            </div>
            <div class=\"modal-footer\">
                <div class=\"container-fluid\">
                    <div class=\"row\">
                        <div class=\"col\">
                            <button type=\"button\" class=\"btn btn-secondary float-end\" data-bs-dismiss=\"modal\">
                                <i class=\"bi bi-x-circle me-1\"></i>
                                Close
                            </button>
                        </div>
                        <div class=\"col p-0\">
                            <button class=\"btn btn-success w-100\" id=\"savePasswordChanges\">
                                <span class=\"bi bi-check-circle me-2\"></span>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
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
        return "home/profile/password.modal.profile.twig";
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
        return new Source("", "home/profile/password.modal.profile.twig", "/var/www/resources/views/home/profile/password.modal.profile.twig");
    }
}
