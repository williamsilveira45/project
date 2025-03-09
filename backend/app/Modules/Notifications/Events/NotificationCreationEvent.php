<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Events;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\Actions\AMQP\SendMessageAMQPAction;
use App\Modules\Core\CoreModule;
use App\Modules\Notifications\Models\Notification;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class NotificationCreationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Notification $notification
    ) {
        $notification = json_encode($notification->toArray());

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'notification_module',
            'queue' => 'notification_create',
            'message' => $notification
        ]);

        CoreModule::sendMessageAMQPAction($message);
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
        return 'notification.created';
    }
}
