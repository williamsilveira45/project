<?php
declare(strict_types=1);

namespace App\Modules\Customers\Events;
;

use App\Modules\Customers\Models\CustomerNote;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerNoteUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public CustomerNote $customerNote,
        public array $originalValues,
        public array $changedValues,
    ) {
        $message = json_encode([
            'note' => $customerNote->toArray(),
            'original' => $originalValues,
            'changed' => $changedValues
        ]);
        RabbitMQService::make()->publish('customer_module', 'customer_note_update', $message);
    }
}
