<?php
declare(strict_types=1);

namespace App\Modules\Users\Data\DTOs;

use App\Modules\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class UserDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?string $email_verified_at,
        public ?string $remember_token,
        public ?Carbon $deleted_at,
        public ?Carbon $created_at,
        public ?Carbon $updated_at
    ) {}

    public static function fromUser(User $user): self
    {
        return new self(
            id: $user->getKey(),
            name: $user->name,
            email: $user->email,
            email_verified_at: $user->email_verified_at,
            remember_token: $user->remember_token,
            deleted_at: $user->deleted_at,
            created_at: $user->created_at,
            updated_at: $user->updated_at
        );
    }

    public static function authorize(): bool
    {
        return Auth::user()->name === 'Ruben';
    }
}

