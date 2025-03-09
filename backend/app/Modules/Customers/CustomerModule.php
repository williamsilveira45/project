<?php
declare(strict_types=1);

namespace App\Modules\Customers;

use App\Modules\AbstractModule;
use App\Modules\Customers\Repositories\Contracts\CustomerRepositoryInterface;
use App\Modules\Customers\Repositories\CustomerRepository;
use Illuminate\Support\Facades\App;

class CustomerModule extends AbstractModule
{
    public function __construct(
        private readonly CustomerRepositoryInterface $repository
    ) {
    }

    /**
     * @return CustomerRepository
     */
    public static function repository(): CustomerRepository
    {
        return App::make(CustomerRepositoryInterface::class);
    }
}
