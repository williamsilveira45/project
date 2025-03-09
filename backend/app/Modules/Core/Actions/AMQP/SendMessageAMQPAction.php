<?php
declare(strict_types=1);

namespace App\Modules\Core\Actions\AMQP;

use App\Modules\Core\Actions\Data\DTOs\AMQP\SendMessageAMQPDTO;
use App\Modules\Core\Contracts\AMQP\AMQPServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SendMessageAMQPAction
{
    public function execute(SendMessageAMQPDTO $amqpData): bool
    {
        try {
            if (app()->environment('testing')) {
                return false;
            }

            if (is_array($amqpData->message) || is_object($amqpData->message)) {
                $amqpData->message = json_encode($amqpData->message);
            }

            $amqpService = App::make(AMQPServiceInterface::class);
            $amqpService->publish($amqpData->exchange, $amqpData->queue, $amqpData->message);

            return true;
        } catch (\Throwable $e) {
            Log::error('Error sending message to AMQP', [
                'error' => $e->getMessage(),
                'exchange' => $amqpData->exchange,
                'queue' => $amqpData->queue,
                'message' => $amqpData->message,
                'trace' => $e->getTrace()
            ]);

            return false;
        }
    }
}
