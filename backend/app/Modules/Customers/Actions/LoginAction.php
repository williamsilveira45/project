<?php
declare(strict_types=1);

namespace App\Modules\Users\Actions;

use App\Modules\Users\Data\Requests\LoginRequestData;
use App\Modules\Users\Events\LoginUserEvent;
use App\Modules\Users\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function execute(LoginRequestData $requestData): User
    {
        if (!Auth::attempt($requestData->toArray())) {
            throw new AuthorizationException('Invalid credentials', 401);
        }

        $user = Auth::user();
        LoginUserEvent::dispatch($user);

        return $user;
    }
}
