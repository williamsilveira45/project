<?php
declare(strict_types=1);

namespace App\Modules\Core\Contracts\AMQP;

interface AMQPServiceInterface
{
    public static function make(): self;
    public function publish(string $exchange, string $queue, string $message): void;
}
