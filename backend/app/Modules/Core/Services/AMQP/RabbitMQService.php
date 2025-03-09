<?php

namespace App\Modules\Core\Services\AMQP;

use App\Modules\Core\Contracts\AMQP\AMQPServiceInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService implements AMQPServiceInterface
{
    private ?AMQPChannel $channel = null;

    public function __construct(
        public AMQPStreamConnection $connection,
    ) {
        //
    }

    public static function make(): self
    {
        $host = config('rabbitmq.host');
        $port = config('rabbitmq.port');
        $user = config('rabbitmq.user');
        $password = config('rabbitmq.password');
        $vhost = config('rabbitmq.vhost');

        $connection = new AMQPStreamConnection($host, $port, $user, $password, $vhost);
        $instance = new self($connection);

        return $instance;
    }

    public function publish(string $exchange, string $queue, string $message): void
    {
        $this->channel = $this->connection->channel();

        $message = new AMQPMessage($message);
        $this->channel->basic_publish($message, $exchange, $queue);
    }

    public function __destruct()
    {
        $this->connection->close();
        if ($this->channel !== null) {
            $this->channel->close();
        }
    }
}
