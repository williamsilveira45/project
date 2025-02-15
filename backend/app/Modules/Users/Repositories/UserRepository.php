<?php
declare(strict_types=1);

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Data\Requests\GetUsersListRequestData;
use App\Modules\Users\Models\User;
use App\Modules\Users\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getList(GetUsersListRequestData $data): LengthAwarePaginator
    {
        return User::query()
            ->when(empty($data->search) === false, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->when($data->sort !== null, function ($query, $sort) use ($data) {
                $query->orderBy($sort, $data->order);
            })
            ->paginate($data->perPage, ['*'], 'page', $data->page);
    }

    public function getUserNotifications(User $user): array
    {
        return $user->notifications->toArray();
    }
}
