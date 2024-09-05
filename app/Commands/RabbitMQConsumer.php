<?php

namespace App\Commands;

use App\Libraries\RabbitMQ\RabbitMQService;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class RabbitMQConsumer extends BaseCommand
{
    const QUEUE_NAME = 'queue_queen';
    protected $group       = 'RabbitMQ';
    protected $name        = 'rabbitmq:consume';
    protected $description = 'Starts the RabbitMQ consumer....';

    public function run(array $params)
    {
        // Instantiate the RabbitMQ service
        $rabbitMQService = new RabbitMQService();

        // Define the callback function to process each message
        $callback = function ($msg) {
            CLI::write('Received: ' . $msg->body, 'green');
            // Here you can add your logic to process the message
        };

        CLI::write($this->description, 'yellow');

        // Start consuming messages from the queue
        $rabbitMQService->consume(self::QUEUE_NAME, $callback);

        // Close the connection when done
        $rabbitMQService->close();
    }
}
