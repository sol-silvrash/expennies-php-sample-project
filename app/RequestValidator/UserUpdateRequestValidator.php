<?php
declare(strict_types=1);

namespace App\RequestValidator;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use Valitron\Validator;
class UserUpdateRequestValidator implements RequestValidatorInterface
{
    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', 'name');

        if (!$v->validate())
            throw new ValidationException($v->errors());

        return $data;
    }
}