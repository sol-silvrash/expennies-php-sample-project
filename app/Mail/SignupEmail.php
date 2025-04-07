<?php
declare(strict_types=1);

namespace App\Mail;

use App\Config;
use App\Entity\User;
use App\SignedURL;
use DateTime;
use Slim\Interfaces\RouteParserInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\BodyRendererInterface;
class SignupEmail
{
    public function __construct(
        private readonly Config $config,
        private readonly MailerInterface $mailer,
        private readonly BodyRendererInterface $renderer,
        private readonly RouteParserInterface $routeParser,
        private readonly SignedURL $signedURL,
    ) {
    }

    public function send(User $user): void
    {
        $userId = $user->getId();
        $email = $user->getEmail();

        $expirationDate = new DateTime('+30 minutes');

        $activationLink = $this->signedURL->fromRoute(
            'verify',
            [
                'id' => $userId,
                'hash' => sha1($email)
            ],
            $expirationDate,
        );

        $message = new TemplatedEmail();
        $message = $message
            ->from($this->config->get('mailer.from'))
            ->to($email)
            ->subject('Welcome to Expennies')
            ->htmlTemplate('email/signup.html.twig')
            ->context([
                'activateLink' => $activationLink,
                'expirationDate' => $expirationDate,
            ]);

        $this->renderer->render($message);

        $this->mailer->send($message);
    }
}