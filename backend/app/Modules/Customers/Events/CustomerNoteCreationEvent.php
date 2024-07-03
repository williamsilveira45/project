<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;

use App\Modules\Customers\Models\CustomerNote;
use App\Services\RabbitMQService;
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
        RabbitMQService::make()->publish('customer_module', 'customer_note_create', $customerNote);
    }
}
