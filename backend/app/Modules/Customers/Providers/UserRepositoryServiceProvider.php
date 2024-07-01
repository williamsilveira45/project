<?php
declare(strict_types=1);

namespace App\Modules\Users\Providers;

use App\Modules\Users\Repositories\Contracts\UserRepositoryInterface;
use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserRepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     * @author w_silveira
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * @return string[]
     * @author w_silveira
     */
    public function provides(): array
    {
        return [
            UserRepositoryInterface::class
        ];
    }
}
