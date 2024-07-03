<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions;

use App\Modules\Customers\Actions\Internal\CustomerAddressSaveAction;
use App\Modules\Customers\Data\Requests\CreateCustomerAddressRequestData;
use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Models\CustomerAddress;

class CreateCustomerAddressAction
{
    public function __construct(
        private readonly CustomerAddressSaveAction $customerAddressSaveAction,
    ) {

    }

    public function execute(CreateCustomerAddressRequestData $data, Customer $customer): CustomerAddress
    {
        $customerAddress = new CustomerAddress();
        $customerAddress->customer_id = $customer->getKey();
        $customerAddress->address_line1 = $data->address_line1;
        $customerAddress->address_line2 = $data->address_line2;
        $customerAddress->city = $data->city;
        $customerAddress->state = $data->state;
        $customerAddress->postal_code = $data->postal_code;
        $customerAddress->country = $data->country;
        $customerAddress->type = $data->type;

        return $this->customerAddressSaveAction->execute($customerAddress);
    }
}
