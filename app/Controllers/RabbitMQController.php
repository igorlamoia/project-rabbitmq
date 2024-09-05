<?php

namespace App\Controllers;

use App\Libraries\RabbitMQ\RabbitMQService;

class RabbitMQController extends BaseController
{
    public function publish()
    {
        $rabbitService = new RabbitMQService();
        $successRoutingKey = 'success';
        $errorRoutingKey = 'error';
        $rabbitService->publish('queue_queen', 'Hello, World!', routingKey: $successRoutingKey);
        $rabbitService->close();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Mensagem publicada!'
        ])->setStatusCode(200);
    }
}
