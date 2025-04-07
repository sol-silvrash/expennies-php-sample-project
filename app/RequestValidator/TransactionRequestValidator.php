<?php
declare(strict_types=1);

namespace App\RequestValidator;

use App\Contracts\RequestValidatorInterface;
use App\Exception\ValidationException;
use App\Services\CategoryService;
use Valitron\Validator;
class TransactionRequestValidator implements RequestValidatorInterface
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    public function validate(array $data): array
    {
        $v = new Validator($data);

        $v->rule('required', ['description', 'date', 'amount', 'category'], false);
        $v->rule('lengthMax', 'description', 255);
        $v->rule('numeric', 'amount');

        if (!$v->validate())
            throw new ValidationException($v->errors());

        return $data;
    }
}