<?php
declare(strict_types=1);

namespace App\Contracts;

use App\Contracts\UserInterface;
use App\DTO\RegisterUserData;
use App\Enums\AuthAttemptStatus;
interface AuthInterface
{
    public function user(): ?UserInterface;

    public function attemptLogin(array $data): AuthAttemptStatus;

    public function attempt2faLogin(array $data): bool;

    public function checkCredentials(UserInterface $user, array $credentials): bool;

    public function register(RegisterUserData $data): UserInterface;

    public function logout(): void;

    public function login(UserInterface $user): void;
}