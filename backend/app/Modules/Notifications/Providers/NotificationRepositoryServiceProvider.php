<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Providers;

use App\Modules\Notifications\Repositories\Contracts\NotificationRepositoryInterface;
use App\Modules\Notifications\Repositories\NotificationRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class NotificationRepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     * @author w_silveira
     */
    public function register(): void
    {
        $this->app->bind(
            NotificationRepositoryInterface::class,
            NotificationRepository::class
        );
    }

    /**
     * @return string[]
     * @author w_silveira
     */
    public function provides(): array
    {
        return [
            NotificationRepositoryInterface::class
        ];
    }
}
