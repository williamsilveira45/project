<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions;

use App\Modules\Customers\Actions\Internal\CustomerPhoneSaveAction;
use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Models\CustomerPhone;
use App\Modules\Customers\Data\Requests\CreateCustomerPhoneRequestData;

class CreateCustomerPhoneAction
{
    public function __construct(
        private readonly CustomerPhoneSaveAction $customerPhoneSaveAction,
    ) {

    }

    public function execute(CreateCustomerPhoneRequestData $data, Customer $customer): CustomerPhone
    {
        $customerPhone = new CustomerPhone();

        $customerPhone->customer_id = $customer->getKey();
        $customerPhone->phone = $data->phone_number;
        $customerPhone->type = $data->type;

        return $this->customerPhoneSaveAction->execute($customerPhone);
    }
}
