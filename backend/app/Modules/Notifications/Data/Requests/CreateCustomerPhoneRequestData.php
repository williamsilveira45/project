<?php
declare(strict_types=1);

namespace App\Modules\Customers\Data\Requests;

use App\Modules\Customers\Enum\CustomerPhoneTypeEnum;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class CreateCustomerPhoneRequestData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $phone_number,
        #[Enum(CustomerPhoneTypeEnum::class)]
        public ?string $type
    ) {}
}
