<?php

namespace App\Controllers;

use App\Libraries\RabbitMQ\RabbitMQService;

class RabbitMQController extends BaseController
{
    public function publish()
    {
        $inputJson = $this->request->getJSON(TRUE);
        $message = json_encode($inputJson);

        $rabbitService = new RabbitMQService();

        $successRoutingKey = 'success';
        $errorRoutingKey = 'error';

        $rabbitService->publish('queue_queen', $message, routingKey: $successRoutingKey);
        $rabbitService->close();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Mensagem publicada!'
        ])->setStatusCode(200);
    }
}
