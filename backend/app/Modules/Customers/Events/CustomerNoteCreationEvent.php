<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\CoreModule;
use App\Modules\Customers\Models\CustomerNote;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerNoteCreationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public CustomerNote $customerNote
    ) {
        $customerNote = json_encode($customerNote->toArray());

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'customer_module',
            'queue' => 'customer_note_create',
            'message' => $customerNote
        ]);

        CoreModule::sendMessageAMQPAction($message);
    }
}
