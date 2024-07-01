<?php
declare(strict_types=1);

namespace App\Modules\Users\Events;

use App\Modules\Users\Models\User;
use App\Services\RabbitMQService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogoutUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user
    ) {
        $user = json_encode($user->toArray());
        RabbitMQService::make()->publish('user_module', 'user_logout', $user);
    }
}
