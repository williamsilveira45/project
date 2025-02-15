<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Actions;

use App\Modules\Notifications\Actions\Internal\NotificationSaveAction;
use App\Modules\Notifications\Models\Notification;

class SetNotificationAsReadAction
{
    public function __construct(
        private readonly NotificationSaveAction $notificationSaveAction,
    ) {

    }

    public function execute(Notification $notification, bool $read): Notification
    {
        $notification->is_read = $read;
        $notification->read_at = $read ? now() : null;

        $notification = $this->notificationSaveAction->execute($notification);

        return $notification;
    }
}
