<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Customers\Models\Customer;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerCreationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Customer $customer
    ) {
        $customer = json_encode($customer->toArray());
        RabbitMQService::make()->publish('customer_module', 'customer_create', $customer);
    }
}
