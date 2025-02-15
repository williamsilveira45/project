<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Data\Requests;

use App\Attributes\Validation\ExistsModel;
use App\Modules\Notifications\Enum\NotificationTypeEnum;
use App\Modules\Users\Models\User;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class CreateUserNotificationRequestData extends Data
{
    public function __construct(
        #[ExistsModel(User::class)]
        public int $from_user_id,
        #[ExistsModel(User::class)]
        public int $to_user_id,
        #[Max(255)]
        public string $title,
        #[Enum(NotificationTypeEnum::class)]
        public string $type,
        #[Max(4096)]
        public string $content
    ) {}
}
