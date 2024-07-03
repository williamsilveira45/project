<?php
declare(strict_types=1);

namespace App\Modules\Customers\Data\Requests;

use App\Modules\Customers\Enum\CustomerAddressTypeEnum;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class CreateCustomerAddressRequestData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $address_line1,
        #[Max(255)]
        public ?string $address_line2,
        #[Max(255)]
        public string $city,
        #[Max(255)]
        public string $state,
        #[Max(255)]
        public string $postal_code,
        #[Max(255)]
        public string $country,
        #[Enum(CustomerAddressTypeEnum::class)]
        public ?string $type
    ) {}
}
