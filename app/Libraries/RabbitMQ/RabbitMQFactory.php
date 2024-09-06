<?php

namespace App\Libraries\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

helper('env');
class RabbitMQFactory
{
  public static function createConnection(string $connectionName = "default"): AMQPStreamConnection
  {
    $prefix = "rabbitmq.$connectionName.";

    $connectionParams = [
      'host' => getenv($prefix . "host"),
      'port' => getenv($prefix . "port"),
      'user' => getenv($prefix . "user"),
      'password' => getenv($prefix . "password"),
      'vhost' => getenv($prefix . "vhost")
    ];

    return new AMQPStreamConnection(...$connectionParams);
  }
}
