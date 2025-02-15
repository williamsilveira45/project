<?php

namespace App\Modules\Users\Facade;

use Illuminate\Support\Facades\Facade;

class UserModuleFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user-module';
    }
}
