<?php
declare(strict_types=1);

namespace App\Modules\Users\Actions;

use App\Modules\Users\Actions\Internal\UserSaveAction;
use App\Modules\Users\Data\Requests\LoginRequestData;
use App\Modules\Users\Data\Requests\UpdateUserRequestData;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserAction
{
    public function __construct(
        private readonly UserSaveAction $userSaveAction,
        private readonly LoginAction $loginAction
    ) {

    }

    public function execute(UpdateUserRequestData $data, User $user): User
    {
        $user->name = $data->name;
        $user->setPassword($data->password);

        $authUserId = Auth::user()->getKey();

        $updatedUser = $this->userSaveAction->execute($user);

        // If the updated user is the currently authenticated user, re-login
        if ($authUserId === $updatedUser->getKey()) {
            $this->loginAction->execute(LoginRequestData::from([
                'email' => $updatedUser->email,
                'password' => $data->password
            ]));
        }

        return $updatedUser;
    }
}
