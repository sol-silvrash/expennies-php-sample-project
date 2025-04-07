<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Contracts\AuthInterface;
use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\SessionInterface;
use App\Entity\User;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly Twig $twig,
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly AuthInterface $auth,
        private readonly SessionInterface $session,
        private readonly BaseEntityManagerServiceInterface $entityManagerService,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($user = $this->auth->user()) {
            $this->twig->getEnvironment()->addGlobal(
                'auth',
                [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                ]
            );

            $this->twig->getEnvironment()->addGlobal('current_route', RouteContext::fromRequest($request)->getRoute()->getName());

            $this->entityManagerService->enableUserAuthFilter($user);

            return $handler->handle($request->withAttribute('user', $user));
        }

        return $this->responseFactory->createResponse(302)->withHeader('Location', '/login');
    }
}