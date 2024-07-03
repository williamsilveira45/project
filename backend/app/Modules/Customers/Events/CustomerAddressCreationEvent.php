<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Customers\Models\CustomerAddress;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerAddressCreationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public CustomerAddress $customerAddress
    ) {
        $customerAddress = json_encode($customerAddress->toArray());
        RabbitMQService::make()->publish('customer_module', 'customer_address_create', $customerAddress);
    }
}
