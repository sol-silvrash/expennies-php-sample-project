<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\UserProviderServiceInterface;
use App\Exception\ValidationException;
use App\Mail\PasswordResetEmail;
use App\RequestValidator\ForgotPasswordRequestValidator;
use App\RequestValidator\ResetPasswordRequestValidator;
use App\Services\PasswordResetService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
class PasswordResetController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly UserProviderServiceInterface $userProviderService,
        private readonly PasswordResetService $passwordResetService,
        private readonly PasswordResetEmail $passwordResetEmail,
    ) {
    }

    public function index(Response $response)
    {
        return $this->twig->render($response, 'auth/forgot.password.twig');
    }

    public function handleRequest(Request $request, Response $response)
    {
        $data = $this->requestValidatorFactory->make(ForgotPasswordRequestValidator::class)->validate($request->getParsedBody());

        $user = $this->userProviderService->getByCredentials($data);

        if ($user) {
            $this->passwordResetService->deactivateAllPasswordResets($data['email']);

            $passwordReset = $this->passwordResetService->generate($data['email']);

            $this->passwordResetEmail->send($passwordReset);
        }

        return $response;
    }

    public function resetPasswordIndex(Response $response, array $args)
    {
        $passwordReset = $this->passwordResetService->fetchByToken($args['token']);

        if (!$passwordReset)
            return $response->withHeader('Location', '/')->withStatus(302);

        return $this->twig->render($response, 'auth/reset.password.twig', ['token' => $args['token']]);
    }

    public function resetPassword(Request $request, Response $response, array $args)
    {
        $data = $this->requestValidatorFactory->make(ResetPasswordRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        $passwordReset = $this->passwordResetService->fetchByToken($args['token']);

        if (!$passwordReset)
            throw new ValidationException(['confirmPassword' => ['Invalid Token']]);

        $user = $this->userProviderService->getByCredentials(['email' => $passwordReset->getEmail()]);

        if (!$user)
            throw new ValidationException(['confirmPassword' => ['InvalidToken']]);

        $this->passwordResetService->updatePassword($user, $data['password']);

        return $response;
    }
}