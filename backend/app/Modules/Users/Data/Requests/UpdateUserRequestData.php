<?php
declare(strict_types=1);

namespace App\Modules\Users\Data\Requests;

use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Data;

class UpdateUserRequestData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $name,
        #[Password(10, true, true, true, true), Confirmed]
        public string $password,
        public string $password_confirmation,
    ) {}
}
