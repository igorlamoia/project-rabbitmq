# Projeto RabbitMQ com CodeIgniter 4

Aplicação de exemplo para demonstrar o uso do RabbitMQ com CodeIgniter 4. Contendo uma rota para publicar mensagens e um consumer para consumir mensagens, inserindo dados no banco de dados.

## Primeiros Passos

Acesse o RabbitMQ e crie uma fila e uma exchange para utilizar na aplicação, acessando http://localhost:15672.

1. Crie uma fila no RabbitMQ com o nome que desejar (utilize na rota de publicação e no consumer)
2. Crie uma exchange no RabbitMQ com o nome que desejar (utilize na rota de publicação e no consumer)

## Para publicar mensagens no RabbitMQ, execute a rota (POST) abaixo com o body da mensagem:

```bash
http://localhost:8080/publish
```

É possível publicar mensagens direto na interface do RabbitMQ, acessando http://localhost:15672.

## Para consumir o RabbitMQ, execute o comando abaixo:

```bash
php spark mq:consume
```

## Requisitos

- PHP 8.1 ou superior
- MySQL
- [Composer](https://getcomposer.org)
- [RabbitMQ](https://www.rabbitmq.com/download.html)
- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- extension=php_sockets.dll (Descomente ou adicione a extensão no php.ini)

## Instalação

1. **Clone o Repositório**:

   ```bash
   git clone https://github.com/igorlamoia/project-rabbitmq.git
   cd project-rabbitmq

   ```

2. **Instale as Dependências**:

   ```bash
   composer install
   ```

3. **Configure o Banco de Dados e o RabbitMQ**:

- Copie o arquivo .env.example para um novo arquivo .env:

  ```bash
  cp .env.example .env

  ```

- Caso não queira utilizar o banco de dados, você pode comentar as linhas referentes a utilização do banco em MessageProcessor

```bash
  database.default.hostname = localhost
  database.default.database = project_rabbitmq
  database.default.username = root
  database.default.password =
  database.default.DBDriver = MySQLi
  database.default.DBPrefix =
  database.default.port = 3306
```

- Configure o RabbitMQ no arquivo .env

```bash
  rabbitmq.default.hostname = localhost
  rabbitmq.default.port = 5672
  rabbitmq.default.username = guest
  rabbitmq.default.password = guest
  rabbitmq.default.vhost = /
```

4. **Crie a base de dados de teste**:

```bash
php spark prepare:db
```

4. **Inicie o Servidor de Desenvolvimento**:

Use o comando abaixo para iniciar o servidor local de desenvolvimento:

```bash
php spark serve --port 8080
```

A aplicação ficará disponível em http://localhost:8080.
