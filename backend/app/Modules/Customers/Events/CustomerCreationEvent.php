<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\CoreModule;
use App\Modules\Customers\Models\Customer;
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

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'customer_module',
            'queue' => 'customer_create',
            'message' => $customer
        ]);

        CoreModule::sendMessageAMQPAction($message);
    }
}
