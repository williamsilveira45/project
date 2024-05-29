<?php

namespace App\Modules\Users\Repositories\Contracts;

use App\Modules\Users\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
