<?php
declare(strict_types=1);

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Actions\CreateUserAction;
use App\Modules\Users\Actions\LoginAction;
use App\Modules\Users\Actions\UpdateUserAction;
use App\Modules\Users\Data\Requests\CreateUserRequestData;
use App\Modules\Users\Data\Requests\LoginRequestData;
use App\Modules\Users\Data\Requests\UpdateUserRequestData;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me(): User
    {
        return Auth::user();
    }

    public function register(CreateUserRequestData $requestData, CreateUserAction $createUserAction): User
    {
        return $createUserAction->execute($requestData);
    }

    public function login(LoginRequestData $requestData, LoginAction $loginAction): User
    {
        return $loginAction->execute($requestData);
    }

    public function update(UpdateUserRequestData $requestData, UpdateUserAction $action, User $user): User
    {
        return $action->execute($requestData, $user);
    }
}
