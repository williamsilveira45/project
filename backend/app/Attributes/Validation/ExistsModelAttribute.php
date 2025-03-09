<?php
declare(strict_types=1);

namespace App\Attributes\Validation;

use Attribute;
use Spatie\LaravelData\Attributes\Validation\Exists;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class ExistsModelAttribute extends Exists
{
    public function __construct(string $modelClass)
    {
        $modelInstance = new $modelClass();
        parent::__construct($modelInstance->getTable(), $modelInstance->getKeyName());
    }
}
