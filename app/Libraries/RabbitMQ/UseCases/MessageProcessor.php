<?php

namespace App\Libraries\RabbitMQ\UseCases;

use CodeIgniter\CLI\CLI;

use App\Models\UserTransferModel;
use PhpAmqpLib\Message\AMQPMessage;


class MessageProcessor
{
  public static function execute(AMQPMessage  $msg) {
    CLI::write('Received: ' . $msg->getBody(), 'green');
    $data = json_decode($msg->getBody(), true);
    $userTransfer = new UserTransferModel();
    $userTransfer->insert($data);

    $msg->ack();
  }

}
