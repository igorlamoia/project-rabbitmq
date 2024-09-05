<?php

namespace App\Commands;

use App\Commands\UseCases\MessageProcessor;
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
        $rabbitMQService = new RabbitMQService();
        CLI::write($this->description, 'yellow');
        $callback = function ($msg) {
            MessageProcessor::execute($msg);
        };

        $rabbitMQService->consume(self::QUEUE_NAME, $callback);
        $rabbitMQService->close();
    }
}
