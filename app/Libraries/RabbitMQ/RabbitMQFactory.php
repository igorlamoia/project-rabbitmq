<?php

namespace App\Libraries\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQFactory {

    public static function createConnection(string $connectionName = ""): AMQPStreamConnection {
      switch ($connectionName) {
        case 'pix':
          $connectionParams = [
            'host' => 'localhost',
            'port' => 5672,
            'user' => 'guest',
            'password' => 'guest',
            'vhost' => '/' // Optional virtual host
          ];
          break;
        default:
          $connectionParams = [
            'host' => 'localhost',
            'port' => 5672,
            'user' => 'guest',
            'password' => 'guest',
            'vhost' => '/' // Optional virtual host
          ];
          break;
      }

      // Unpack the array into AMQPStreamConnection arguments
      return new AMQPStreamConnection(...$connectionParams);
    }
}