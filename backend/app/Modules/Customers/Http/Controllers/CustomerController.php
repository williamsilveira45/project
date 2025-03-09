<?php
declare(strict_types=1);

namespace App\Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Customers\Actions\CreateCustomerAction;
use App\Modules\Customers\Actions\CreateCustomerAddressAction;
use App\Modules\Customers\Actions\CreateCustomerNoteAction;
use App\Modules\Customers\Actions\CreateCustomerPhoneAction;
use App\Modules\Customers\Data\Requests\CreateCustomerAddressRequestData;
use App\Modules\Customers\Data\Requests\CreateCustomerNoteRequestData;
use App\Modules\Customers\Data\Requests\CreateCustomerPhoneRequestData;
use App\Modules\Customers\Data\Requests\CreateCustomerRequestData;
use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Models\CustomerAddress;
use App\Modules\Customers\Models\CustomerNote;
use App\Modules\Customers\Models\CustomerPhone;

class CustomerController extends Controller
{
    public function create(CreateCustomerRequestData $request, CreateCustomerAction $action): Customer
    {
        return $action->execute($request);
    }

    public function createAddress(CreateCustomerAddressRequestData $request, CreateCustomerAddressAction $action, Customer $customer): CustomerAddress
    {
        return $action->execute($request, $customer);
    }

    public function createNote(CreateCustomerNoteRequestData $request, CreateCustomerNoteAction $action, Customer $customer): CustomerNote
    {
        return $action->execute($request, $customer);
    }

    public function createPhone(CreateCustomerPhoneRequestData $request, CreateCustomerPhoneAction $action, Customer $customer): CustomerPhone
    {
        return $action->execute($request, $customer);
    }

}
