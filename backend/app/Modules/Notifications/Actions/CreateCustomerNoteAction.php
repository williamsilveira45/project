<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions;

use App\Modules\Customers\Actions\Internal\CustomerNoteSaveAction;
use App\Modules\Customers\Data\Requests\CreateCustomerNoteRequestData;
use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Models\CustomerNote;

class CreateCustomerNoteAction
{
    public function __construct(
        private readonly CustomerNoteSaveAction $customerNoteSaveAction,
    ) {

    }

    public function execute(CreateCustomerNoteRequestData $data, Customer $customer): CustomerNote
    {
        $customerNote = new CustomerNote();
        $customerNote->customer_id = $customer->getKey();
        $customerNote->note = $data->note;
        $customerNote->type = $data->type;
        $customerNote->created_by = $data->created_by;

        return $this->customerNoteSaveAction->execute($customerNote);
    }
}
