<?php
declare(strict_types=1);

namespace App\RequestValidator;

use App\Contracts\RequestValidatorInterface;
use App\Entity\User;
use App\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Valitron\Validator;
class RegisterUserRequestValidator implements RequestValidatorInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', ['name', 'email', 'password', 'confirmPassword']);
        $v->rule('equals', 'confirmPassword', 'password')->label('Confirm Password');
        $v->rule('email', 'email');
        $v->rule(
            fn($field, $value, $params, $fields) => !$this->entityManager->getRepository(User::class)->count([
                'email' => $value
            ]),
            'email'
        )->message('Email Address already exists');

        if (!$v->validate())
            throw new ValidationException($v->errors());

        return $data;
    }
}