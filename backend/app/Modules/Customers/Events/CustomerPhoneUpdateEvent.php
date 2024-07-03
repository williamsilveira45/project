<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;
;

use App\Modules\Customers\Models\CustomerPhone;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerPhoneUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public CustomerPhone $customerPhone,
        public array $originalValues,
        public array $changedValues,
    ) {
        $message = json_encode([
            'phone' => $customerPhone->toArray(),
            'original' => $originalValues,
            'changed' => $changedValues
        ]);
        RabbitMQService::make()->publish('customer_module', 'customer_phone_update', $message);
    }
}
