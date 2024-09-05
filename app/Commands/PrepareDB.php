<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class PrepareDB extends BaseCommand
{
    protected $group = 'Database';
    protected $name = 'prepare:db';
    protected $description = 'Criating database, running migrations.';

    private $dbGroup = 'default';

    public function run(array $params)
    {
        $dbConfigDefault = db_connect($this->dbGroup);
        $this->createDBIfNotExists($dbConfigDefault);

        CLI::write('Executing migrations for the default database...', 'yellow');
        $this->migrate($this->dbGroup);
    }

    private function createDBIfNotExists($dbConfig)
    {
        $databaseName = $dbConfig->getDatabase();
        $dbConnection = new \mysqli($dbConfig->hostname, $dbConfig->username, $dbConfig->password);

        if ($dbConnection->connect_error) return CLI::error('Error connecting to MySQL: ' . $dbConnection->connect_error);
        $queryString = 'CREATE DATABASE IF NOT EXISTS `' . $databaseName . '`';

        if ($dbConnection->query($queryString)) CLI::write('Database: `' . $databaseName . '` online.', 'green');
        else CLI::error('Error connecting to DB: ' . $dbConnection->error);

        $dbConnection->close();
    }

    private function migrate($group)
    {
        CLI::write("Executing all migrations from '$group'...", 'yellow');
        chdir(ROOTPATH);
        exec('php spark migrate --group ' . $group, $output, $returnVar);

        CLI::write(implode("\n", $output), $returnVar === 0 ? 'green' : 'red');
    }
}
