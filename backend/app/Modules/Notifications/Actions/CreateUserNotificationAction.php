<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Actions;

use App\Modules\Notifications\Actions\Internal\NotificationSaveAction;
use App\Modules\Notifications\Data\Requests\CreateUserNotificationRequestData;
use App\Modules\Notifications\Models\Notification;

class CreateUserNotificationAction
{
    public function __construct(
        private readonly NotificationSaveAction $notificationSaveAction,
    ) {

    }

    public function execute(CreateUserNotificationRequestData $data): Notification
    {
        $notification = new Notification();

        $notification->from_user_id = $data->from_user_id;
        $notification->to_user_id = $data->to_user_id;
        $notification->title = $data->title;
        $notification->type = $data->type;
        $notification->content = $data->content;

        $notification = $this->notificationSaveAction->execute($notification);

        return $notification;
    }
}
