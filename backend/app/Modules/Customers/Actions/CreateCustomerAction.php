<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions;

use App\Modules\Customers\Actions\Internal\CustomerSaveAction;
use App\Modules\Customers\Data\Requests\CreateCustomerRequestData;
use App\Modules\Customers\Models\Customer;

class CreateCustomerAction
{
    public function __construct(
        private readonly CustomerSaveAction $customerSaveAction,
        private readonly CreateCustomerAddressAction $createCustomerAddressAction,
        private readonly CreateCustomerNoteAction $createCustomerNoteAction,
        private readonly CreateCustomerPhoneAction $createCustomerPhoneAction,
    ) {

    }

    public function execute(CreateCustomerRequestData $data): Customer
    {
        $customer = new Customer();
        $customer->first_name = $data->first_name;
        $customer->last_name = $data->last_name;
        $customer->email = $data->email;
        $customer->cpf_cnpj = $data->cpf_cnpj;
        $customer->rg = $data->rg;
        $customer->status = $data->status;
        $customer->birth_date = $data->birth_date;

        $customer = $this->customerSaveAction->execute($customer);

        if (false === empty($data->address)) {
            $this->createCustomerAddressAction->execute($data->address, $customer);
        }

        if (false === empty($data->phone)) {
            $this->createCustomerPhoneAction->execute($data->phone, $customer);
        }

        return $customer;
    }
}
