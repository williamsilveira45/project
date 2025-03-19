<?php
declare(strict_types=1);

namespace App\Modules\Core;

use App\Modules\AbstractModule;

/**
 * @method static bool SendMessageAMQPAction(SendMessageAMQPDTO $dataRequest)
 */
class CoreModule extends AbstractModule
{
    public static function repository(): mixed
    {
        return null;
    }

    public static function getPermissions(): array
    {
        return [];
    }
}
