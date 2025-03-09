<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;
;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\CoreModule;
use App\Modules\Customers\Models\CustomerPhone;
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

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'customer_module',
            'queue' => 'customer_phone_update',
            'message' => $message
        ]);

        CoreModule::sendMessageAMQPAction($message);
    }
}
