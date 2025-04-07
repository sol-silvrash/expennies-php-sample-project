<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\UserProviderServiceInterface;
use App\Entity\User;
use App\Exception\ValidationException;
use App\RequestValidator\ProfilePasswordRequestValidator;
use App\RequestValidator\UserUpdateRequestValidator;
use App\ResponseFormatter;
use App\Services\BaseEntityManagerService;
use App\Services\ProfileService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
class ProfileController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly UserProviderServiceInterface $userProviderService,
        private readonly ProfileService $profileService,
        private readonly ResponseFormatter $responseFormatter,
        private readonly BaseEntityManagerServiceInterface $entityManager,
    ) {
    }

    public function index(Request $request, Response $response)
    {
        /**
         * @var User $user
         */
        $user = $request->getAttribute('user');

        return $this->twig->render(
            $response,
            'home/profile/profile.twig',
            [
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'tfa' => (!$user->hasTwoFactorAuthEnabled()) ? 0 : 1,
            ]
        );
    }

    public function update(Request $request, Response $response)
    {
        /**
         * @var User $user
         */
        $user = $request->getAttribute('user');
        $data = $this->requestValidatorFactory->make(UserUpdateRequestValidator::class)->validate($request->getParsedBody());

        $this->userProviderService->saveUserChanges($user, $data['name'], $data['is2fa']);
        return $response;
    }

    public function changePassword(Request $request, Response $response)
    {
        /**
         * @var User $user
         */
        $user = $request->getAttribute('user');
        
        $data = $this->requestValidatorFactory->make(ProfilePasswordRequestValidator::class)->validate($request->getParsedBody());

        if (!$this->profileService->verifyPassword($user, $data))
            throw new ValidationException(['currentPassword' => ['Incorrect password']]);

        $this->profileService->updatePassword($user, $data);

        $this->entityManager->sync($user);

        return $response;
    }
}