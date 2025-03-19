<?php
declare(strict_types=1);

namespace App\Modules\Customers;

use App\Modules\AbstractModule;
use App\Modules\Customers\Enum\CustomerPermissionEnum;
use App\Modules\Customers\Repositories\Contracts\CustomerRepositoryInterface;
use App\Modules\Customers\Repositories\CustomerRepository;
use Illuminate\Support\Facades\App;

class CustomerModule extends AbstractModule
{
    /**
     * @return CustomerRepository
     */
    public static function repository(): CustomerRepository
    {
        return App::make(CustomerRepositoryInterface::class);
    }

    public static function getPermissions(): array
    {
        return CustomerPermissionEnum::getValues();
    }
}
