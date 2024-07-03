<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Customers\Models\CustomerPhone;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerPhoneCreationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public CustomerPhone $customerPhone
    ) {
        $customerPhone = json_encode($customerPhone->toArray());
        RabbitMQService::make()->publish('customer_module', 'customer_phone_create', $customerPhone);
    }
}
