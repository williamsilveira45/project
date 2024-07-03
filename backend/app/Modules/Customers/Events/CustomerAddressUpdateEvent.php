<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;
;

use App\Modules\Customers\Models\CustomerAddress;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerAddressUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public CustomerAddress $customerAddress,
        public array $originalValues,
        public array $changedValues,
    ) {
        $message = json_encode([
            'address' => $customerAddress->toArray(),
            'original' => $originalValues,
            'changed' => $changedValues
        ]);
        RabbitMQService::make()->publish('customer_module', 'customer_address_update', $message);
    }
}
