<?php
declare(strict_types=1);

namespace App\Modules\Customers\Data\Requests;

use App\Modules\Customers\Enum\CustomerNoteTypeEnum;
use App\Modules\Customers\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class CreateCustomerNoteRequestData extends Data
{
    public function __construct(
        #[Exists(Customer::class)]
        public int $customer_id,
        public string $note,
        #[Enum(CustomerNoteTypeEnum::class)]
        public CustomerNoteTypeEnum $type,
        public ?int $created_by
    ) {}

    public function fromRequest(array $data): self
    {
        return new self(
            customer_id: (int) $data['customer_id'],
            note: $data['note'],
            type: $data['type'],
            created_by: $data['created_by'] ?? Auth::id(),
        );
    }
}
