<?php
declare(strict_types=1);

namespace App\Modules\Users\Data\Requests;

use App\Modules\Users\Models\User;
use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class CreateUserRequestData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $name,
        #[Unique(User::class, 'email')]
        public string $email,
        #[Password(10, true, true, true, true), Confirmed]
        public string $password,
        public string $password_confirmation,
    ) {}
}
