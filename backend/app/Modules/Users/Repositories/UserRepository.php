<?php
declare(strict_types=1);

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
