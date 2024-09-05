## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

## Para preparar o banco de dados, subindo a database e as tabelas, execute o comando abaixo:

prepare:db

## No php.ini

extension=php_sockets.dll

Configure o banco de dados default no arquivo .env

## Para consumir o RabbitMQ, execute o comando abaixo:

mq:consume
