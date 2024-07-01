<?php
declare(strict_types=1);

namespace App\Modules\Users\Actions;

use App\Modules\Users\Actions\Internal\UserSaveAction;
use App\Modules\Users\Data\Requests\CreateUserRequestData;
use App\Modules\Users\Models\User;

class CreateUserAction
{
    public function __construct(
        private readonly UserSaveAction $userSaveAction,
    ) {

    }

    public function execute(CreateUserRequestData $data): User
    {
        $user = new User();

        $user->name = $data->name;
        $user->email = $data->email;
        $user->setPassword($data->password);

        return $this->userSaveAction->execute($user);
    }
}
