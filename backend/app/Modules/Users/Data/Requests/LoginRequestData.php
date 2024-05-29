<?php
declare(strict_types=1);

namespace App\Modules\Users\Data\Requests;

use App\Modules\Users\Models\User;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class LoginRequestData extends Data
{
    public function __construct(
        #[Exists(User::class, 'email')]
        public string $email,
        public string $password,
    ) {}
}
