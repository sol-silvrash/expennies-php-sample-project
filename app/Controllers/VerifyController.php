<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\UserProviderServiceInterface;
use App\Entity\User;
use App\Mail\SignupEmail;
use App\ResponseFormatter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;
use Slim\Views\Twig;
class VerifyController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly UserProviderServiceInterface $userProviderService,
        private readonly SignupEmail $signupEmail,
        private readonly ResponseFormatter $responseFormatter,
    ) {
    }

    public function index(ResponseInterface $response, ServerRequestInterface $request)
    {
        return $this->twig->render(
            $response,
            'email/verify.twig'
        );
    }

    public function verify(ResponseInterface $response, ServerRequestInterface $request, array $args): ResponseInterface
    {
        /**
         * @var User $user
         */
        $user = $request->getAttribute('user');

        if (!hash_equals($user->getId()->toString(), $args['id']) || !hash_equals(sha1($user->getEmail()), $args['hash']))
            throw new RuntimeException('Verification failed');

        if (!$user->getVerifiedAt())
            $this->userProviderService->verifyUser($user);

        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function resend(ResponseInterface $response, ServerRequestInterface $request): ResponseInterface
    {
        /**
         * @var User $user
         */
        $user = $request->getAttribute('user');
        $this->signupEmail->send($user);

        return $this->responseFormatter->asJson($response, []);
    }
}