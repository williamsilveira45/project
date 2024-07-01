<?php
declare(strict_types=1);

namespace App\Modules\Users\Events;
;
use App\Modules\Users\Models\User;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
        public array $originalValues,
        public array $changedValues,
    ) {
        $message = json_encode([
            'user' => $user->toArray(),
            'original' => $originalValues,
            'changed' => $changedValues
        ]);
        RabbitMQService::make()->publish('user_module', 'user_update', $message);
    }
}
