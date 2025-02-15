<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Data\DTOs;

use App\Modules\Notifications\Enum\NotificationTypeEnum;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Users\Data\DTOs\UserDTO;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class NotificationDTO extends Data
{
    public function __construct(
        public int $id,
        public UserDTO $fromUser,
        public UserDTO $toUser,
        public string $title,
        public NotificationTypeEnum $type,
        public string $content,
        public bool $is_read,
        public ?Carbon $read_at,
        public ?Carbon $created_at,
        public ?Carbon $updated_at,
        public ?Carbon $deleted_at,
    ) {}

    public static function fromNotification(Notification $notification): self
    {
        return new self(
            id: $notification->getKey(),
            fromUser: UserDTO::from($notification->fromUser),
            toUser: UserDTO::from($notification->toUser),
            title: $notification->title,
            type: $notification->type,
            content: $notification->content,
            is_read: $notification->is_read,
            read_at: $notification->read_at,
            created_at: $notification->created_at,
            updated_at: $notification->updated_at,
            deleted_at: $notification->deleted_at,
        );
    }
}
