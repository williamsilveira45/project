<?php
declare(strict_types=1);

namespace App\Modules\Customers\Data\Requests;

use App\Modules\Customers\Enum\CustomerStatusEnum;
use App\Modules\Customers\Rules\ValidCpfCnpjRule;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class CreateCustomerRequestData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $first_name,
        #[Max(255)]
        public string $last_name,
        #[Email]
        public ?string $email,
        #[ValidCpfCnpjRule]
        public ?string $cpf_cnpj,
        public ?string $rg,
        #[Enum(CustomerStatusEnum::class)]
        public string $status,
        public string $birth_date,
        public ?CreateCustomerAddressRequestData $address,
        public ?CreateCustomerPhoneRequestData $phone
    ) {}
}
