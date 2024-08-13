<?php
declare(strict_types=1);

namespace App\Modules\Customers\Repositories\Contracts;

use App\Modules\Customers\Models\Customer;

interface CustomerRepositoryInterface
{
    public function find(int $id): ?Customer;
}
