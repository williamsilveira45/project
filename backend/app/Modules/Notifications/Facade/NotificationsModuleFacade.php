<?php

namespace App\Modules\Users\Facade;

use Illuminate\Support\Facades\Facade;

class NotificationsModuleFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'notifications-module';
    }
}
