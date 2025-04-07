<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\AuthInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\DTO\RegisterUserData;
use App\Enums\AuthAttemptStatus;
use App\Exception\ValidationException;
use App\RequestValidator\RegisterUserRequestValidator;
use App\RequestValidator\TwoFactorLoginRequestValidator;
use App\RequestValidator\UserLoginRequestValidator;
use App\ResponseFormatter;
use App\Services\HashService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class AuthController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly AuthInterface $auth,
        private readonly ResponseFormatter $responseFormatter,
    ) {
    }

    public function loginView(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'auth/login.twig');
    }

    public function registerView(Request $request, Response $response)
    {
        return $this->twig->render($response, 'auth/register.twig');
    }

    public function login(Request $request, Response $response): Response
    {
        $data = $this->requestValidatorFactory->make(UserLoginRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        $status = $this->auth->attemptLogin($data);

        if ($status === AuthAttemptStatus::FAILED)
            throw new ValidationException(['password' => ['You have entered an invalid username or password']]);

        if ($status === AuthAttemptStatus::TWO_FACTOR_AUTH)
            return $this->responseFormatter->asJson($response, ['two_factor' => true]);

        return $this->responseFormatter->asJson($response);
    }

    public function twoFactorLogin(Request $request, Response $response): Response
    {
        $data = $this->requestValidatorFactory->make(TwoFactorLoginRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        if (!$this->auth->attempt2faLogin($data))
            throw new ValidationException(['code' => ['Invalid Code']]);

        return $response;
    }

    public function logout(Request $request, Response $response): Response
    {
        $this->auth->logout();

        return $response->withHeader('Location', '/')->withStatus(302);
    }

    public function register(Request $request, Response $response): Response
    {
        $data = $this->requestValidatorFactory->make(RegisterUserRequestValidator::class)->validate($request->getParsedBody());

        $this->auth->register(
            new RegisterUserData(
                $data['name'],
                $data['email'],
                $data['password']
            )
        );

        return $response->withHeader('Location', '/')->withStatus(302);
    }
}