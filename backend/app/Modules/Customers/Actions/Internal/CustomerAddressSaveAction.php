<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions\Internal;

use App\Modules\Customers\Events\CustomerAddressCreationEvent;
use App\Modules\Customers\Events\CustomerAddressUpdateEvent;
use App\Modules\Customers\Models\CustomerAddress;

class CustomerAddressSaveAction
{
    public function execute(CustomerAddress $customerAddress): CustomerAddress
    {
        if ($customerAddress->exists) {
            return $this->update($customerAddress);
        }

        return $this->create($customerAddress);
    }

    public function update(CustomerAddress $customerAddress): CustomerAddress
    {
        $originalValues = $customerAddress->getOriginal();
        $changedValues = $customerAddress->getDirty();

        $customerAddress->save();

        $customerAddress = $customerAddress->refresh();

        CustomerAddressUpdateEvent::dispatch($customerAddress, $originalValues, $changedValues);

        return $customerAddress;
    }

    public function create(CustomerAddress $customerAddress): CustomerAddress
    {
        $customerAddress->save();

        $customerAddress = $customerAddress->refresh();

        CustomerAddressCreationEvent::dispatch($customerAddress);

        return $customerAddress;
    }
}
