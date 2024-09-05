<?php

namespace App\Commands\UseCases;
use PhpAmqpLib\Message\AMQPMessage;
use UserTransferModel;

class MessageProcessor
{
  public static function execute(AMQPMessage  $msg) {
    // CLI::write('Received: ' . $msg->body, 'green');
    // echo json_decode($msg);
    $data = json_decode($msg->getBody(), true);
    // $db = db_connect();
    // $db->table('user_transfer')->insert($data);
    $userTransfer = new UserTransferModel();
    $userTransfer->insert($data);
    $msg->ack();
    // Here you can add your logic to process the message
  }

}
