<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions\Internal;

use App\Modules\Customers\Events\CustomerCreationEvent;
use App\Modules\Customers\Events\CustomerUpdateEvent;
use App\Modules\Customers\Models\Customer;

class CustomerSaveAction
{
    public function execute(Customer $customer): Customer
    {
        if ($customer->exists) {
            return $this->update($customer);
        }

        return $this->create($customer);
    }

    public function update(Customer $customer): Customer
    {
        $originalValues = $customer->getOriginal();
        $changedValues = $customer->getDirty();

        $customer->save();

        $customer = $customer->refresh();

        CustomerUpdateEvent::dispatch($customer, $originalValues, $changedValues);

        return $customer;
    }

    public function create(Customer $customer): Customer
    {
        $customer->save();

        $customer = $customer->refresh();

        CustomerCreationEvent::dispatch($customer);

        return $customer;
    }
}
