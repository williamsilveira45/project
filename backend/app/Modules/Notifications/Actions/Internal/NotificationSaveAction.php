<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Actions\Internal;

use App\Modules\Notifications\Events\NotificationCreationEvent;
use App\Modules\Notifications\Events\NotificationUpdateEvent;
use App\Modules\Notifications\Models\Notification;

class NotificationSaveAction
{
    public function execute(Notification $notification): Notification
    {
        if ($notification->exists) {
            return $this->update($notification);
        }

        return $this->create($notification);
    }

    public function update(Notification $notification): Notification
    {
        $originalValues = $notification->getOriginal();
        $changedValues = $notification->getDirty();

        $notification->save();

        $notification = $notification->refresh();

        NotificationUpdateEvent::dispatch($notification, $originalValues, $changedValues);

        return $notification;
    }

    public function create(Notification $notification): Notification
    {
        $notification->save();

        $notification = $notification->refresh();

        NotificationCreationEvent::dispatch($notification);

        return $notification;
    }
}
