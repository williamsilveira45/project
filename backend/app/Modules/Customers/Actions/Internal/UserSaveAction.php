<?php
declare(strict_types=1);

namespace App\Modules\Users\Actions\Internal;

use App\Modules\Users\Events\UserCreationEvent;
use App\Modules\Users\Events\UserUpdateEvent;
use App\Modules\Users\Models\User;

class UserSaveAction
{
    public function execute(User $user): User
    {
        if ($user->exists) {
            return $this->update($user);
        }

        return $this->create($user);
    }

    public function update(User $user): User
    {
        $originalValues = $user->getOriginal();
        $changedValues = $user->getDirty();

        $user->save();

        $user = $user->refresh();

        UserUpdateEvent::dispatch($user, $originalValues, $changedValues);

        return $user;
    }

    public function create(User $user): User
    {
        $user->save();

        $user = $user->refresh();

        UserCreationEvent::dispatch($user);

        return $user;
    }
}
