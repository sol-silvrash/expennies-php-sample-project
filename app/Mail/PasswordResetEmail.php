<?php
declare(strict_types=1);

namespace App\Mail;

use App\Config;
use App\Entity\PasswordReset;
use App\SignedURL;
use Slim\Interfaces\RouteParserInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\BodyRendererInterface;
class PasswordResetEmail
{
    public function __construct(
        private readonly Config $config,
        private readonly MailerInterface $mailer,
        private readonly BodyRendererInterface $renderer,
        private readonly RouteParserInterface $routeParser,
        private readonly SignedURL $signedURL,
    ) {
    }

    public function send(PasswordReset $passwordReset)
    {
        $email = $passwordReset->getEmail();
        $resetLink = $this->signedURL->fromRoute(
            'password-reset',
            [
                'token' => $passwordReset->getToken()
            ],
            $passwordReset->getExpiration(),
        );

        $message = (new TemplatedEmail())
            ->from($this->config->get('mailer.from'))
            ->to($email)
            ->subject('Your Expennies Password Reset Instructions')
            ->htmlTemplate('email/password.reset.html.twig')
            ->context([
                'resetLink' => $resetLink,
            ]);

        $this->renderer->render($message);

        $this->mailer->send($message);
    }
}