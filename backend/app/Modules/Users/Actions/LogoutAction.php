<?php
declare(strict_types=1);

namespace App\Modules\Users\Actions;

use App\Modules\Users\Data\Requests\LoginRequestData;
use App\Modules\Users\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public function execute(User $user): bool
    {
        if (!Auth::attempt($requestData->only('email', 'password'))) {
            throw new AuthorizationException('Invalid credentials', 401);
        }

        return Auth::user();
    }
}
