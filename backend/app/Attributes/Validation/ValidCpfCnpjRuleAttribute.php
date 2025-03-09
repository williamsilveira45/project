<?php
declare(strict_types=1);

namespace App\Attributes\Validation;

use App\Modules\Customers\Rules\ValidCpfCnpjRule;
use Attribute;
use Spatie\LaravelData\Attributes\Validation\CustomValidationAttribute;
use Spatie\LaravelData\Support\Validation\ValidationPath;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class ValidCpfCnpjRuleAttribute extends CustomValidationAttribute
{
    public function getRules(ValidationPath $path): array
    {
        return [new ValidCpfCnpjRule()];
    }
}
