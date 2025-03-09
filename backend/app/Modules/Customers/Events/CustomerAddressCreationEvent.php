<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\CoreModule;
use App\Modules\Customers\Models\CustomerAddress;
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
        public CustomerAddress $customerAddress,
    ) {
        $customerAddress = json_encode($customerAddress->toArray());

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'customer_module',
            'queue' => 'customer_address_create',
            'message' => $customerAddress
        ]);

        CoreModule::sendMessageAQMPAction($message);
    }
}
