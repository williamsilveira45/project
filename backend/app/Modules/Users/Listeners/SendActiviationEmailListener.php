<?php
declare(strict_types=1);

namespace App\Modules\Users\Listeners;

use App\Modules\Users\Events\UserCreationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendActiviationEmailListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreationEvent $event): void
    {
        \Log::info('Send activation email to ' . $event->user->email);
    }
}
