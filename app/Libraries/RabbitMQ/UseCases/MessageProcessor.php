<?php

namespace App\Commands\UseCases;
use PhpAmqpLib\Message\AMQPMessage;

class MessageProcessor
{
  public static function execute(AMQPMessage  $msg) {
    // CLI::write('Received: ' . $msg->body, 'green');
    // echo json_decode($msg);
    $db = db_connect();
    $data = json_decode($msg->getBody(), true);
    $db->table('user_transfer')->insert($data);
    $msg->ack();
    // Here you can add your logic to process the message
  }

}
