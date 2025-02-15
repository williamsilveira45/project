<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Repositories\Contracts;

use App\Modules\Notifications\Models\Notification;

interface NotificationRepositoryInterface
{
    public function find(int $id): ?Notification;
}
