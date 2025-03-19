<?php

namespace App\Providers;

use App\Modules\Core\Contracts\AMQP\AMQPServiceInterface;
use App\Modules\Core\Services\AMQP\RabbitMQService;
use Exception;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AMQPServiceInterface::class, function () {
            if (config('amqp.driver') === 'rabbitmq') {
                return RabbitMQService::make();
            }

            throw new Exception('AMQP driver not found');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
