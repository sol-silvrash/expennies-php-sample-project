<?php
declare(strict_types=1);

namespace App\RequestValidator;

use App\Contracts\BaseEntityManagerServiceInterface;
use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use Valitron\Validator;
class ProfilePasswordRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', 'currentPassword')->label("Current Password");
        $v->rule('required', 'newPassword')->label("New Password");

        if (!$v->validate())
            throw new ValidationException($v->errors());

        return $data;
    }
}