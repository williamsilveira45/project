<?php
declare(strict_types=1);

namespace App\Modules\Users\Events;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\CoreModule;
use App\Modules\Users\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginUserEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $queue = 'users';

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user
    ) {
        $user = json_encode($user->toArray());

        $message = SendMessageAMQPDTO::from([
            'exchange' => 'user_module',
            'queue' => 'user_login',
            'message' => $user
        ]);

        CoreModule::sendMessageAMQPAction($message);
    }

    public function broadcastOn(): array
    {
        return ['users'];
    }

    public function broadcastAs(): string
    {
        return 'user.login';
    }

    public function broadcastWith(): array
    {
        return [
            'user' => $this->user->toArray(),
        ];
    }
}
