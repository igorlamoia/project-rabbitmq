<?php

namespace App\Libraries\RabbitMQ;

use App\Libraries\RabbitMQ\RabbitMQFactory;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private $connection;
    private $channel;

    public function __construct()
    {
        // Establish a connection with RabbitMQ
        $this->connection = RabbitMQFactory::createConnection();
        $this->channel = $this->connection->channel();
    }

    public function consume(string $queueName, callable $callback)
    {
        // Declare the queue
        $this->channel->queue_declare($queueName, false, true, false, false);

        // Set up the consumer
        $this->channel->basic_consume(
            $queueName,
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        // Wait for the messages
        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function publish(string $queueName, string $message, string $exchange = 'main_exchange', $routingKey = 'success')
    {
        // Declare the queue
        $this->channel->queue_declare($queueName, false, true, false, false);

        // Create a message
        $msg = new AMQPMessage($message);

        // Publish the message
        $this->channel->basic_publish($msg, $exchange, $routingKey);
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
