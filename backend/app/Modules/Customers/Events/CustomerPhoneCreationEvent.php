<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\CoreModule;
use App\Modules\Customers\Models\CustomerPhone;
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

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'customer_module',
            'queue' => 'customer_phone_create',
            'message' => $customerPhone
        ]);

        CoreModule::sendMessageAMQPAction($message);
    }
}
