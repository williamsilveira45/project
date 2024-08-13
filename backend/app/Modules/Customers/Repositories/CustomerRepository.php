<?php
declare(strict_types=1);

namespace App\Modules\Customers\Repositories;

use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function find(int $id): ?Customer
    {
        return Customer::find($id);
    }
}
