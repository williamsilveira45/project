<?php
declare(strict_types=1);

namespace App\Modules\Core\Actions\Data\DTOs\AMQP;

use Spatie\LaravelData\Data;

class SendMessageAMQPDTO extends Data
{
    public function __construct(
        public mixed $exchange,
        public mixed $queue,
        public mixed $message
    ) {

    }
}
