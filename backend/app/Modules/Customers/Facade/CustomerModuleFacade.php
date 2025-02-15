<?php

namespace App\Modules\Users\Facade;

use Illuminate\Support\Facades\Facade;

class CustomerModuleFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'customer-module';
    }
}
