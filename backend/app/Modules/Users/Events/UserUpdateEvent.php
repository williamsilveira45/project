<?php
declare(strict_types=1);

namespace App\Modules\Users\Events;
;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\CoreModule;
use App\Modules\Users\Models\User;
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

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'user_module',
            'queue' => 'user_update',
            'message' => $message
        ]);

        CoreModule::sendMessageAMQPAction($message);
    }
}
