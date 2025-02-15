<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Events;

use App\Modules\Notifications\Models\Notification;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationUpdateEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Notification $notification,
        public array $originalValues,
        public array $changedValues,
    ) {
        $message = json_encode([
            'notification' => $notification->toArray(),
            'original' => $originalValues,
            'changed' => $changedValues
        ]);
        RabbitMQService::make()->publish('notification_module', 'notification_update', $message);
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            sprintf('notification_%d', $this->notification->to_user_id)
        ];
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'notification' => $this->notification
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'notification.updated';
    }
}
