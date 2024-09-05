<?php

namespace Config;

use CodeIgniter\CLI\Commands as CLICommands;

class Commands extends CLICommands
{
    public function __construct()
    {
        parent::__construct();

        // Register your custom command
        $this->commands['geass'] = RabbitMQConsumer::class;
    }
}
