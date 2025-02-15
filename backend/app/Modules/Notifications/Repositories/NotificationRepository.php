<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Repositories;

use App\Modules\Notifications\Models\Notification;
use App\Modules\Notifications\Repositories\Contracts\NotificationRepositoryInterface;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function find(int $id): ?Notification
    {
        return Notification::find($id);
    }
}
