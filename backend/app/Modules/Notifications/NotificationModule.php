<?php
declare(strict_types=1);

namespace App\Modules\Notifications;

use App\Modules\AbstractModule;
use App\Modules\Notifications\Enum\NotificationPermissionEnum;
use App\Modules\Notifications\Repositories\Contracts\NotificationRepositoryInterface;
use App\Modules\Notifications\Repositories\NotificationRepository;
use Illuminate\Support\Facades\App;

class NotificationModule extends AbstractModule
{
    /**
     * @return NotificationRepository
     */
    public static function repository(): NotificationRepository
    {
        return App::make(NotificationRepositoryInterface::class);
    }

    public static function getPermissions(): array
    {
        return NotificationPermissionEnum::getValues();
    }
}
