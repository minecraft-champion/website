<?php

namespace App\DBConnector;

class EasyConnector
{
    public function __construct(
        private string $dbName,
        private ?string $username = "root",
        private ?string $password = "root",
        private ?string $type = "mysql",
        private ?string $host = "localhost",
        private ?string $port = "6123"
    ){}

    public function getDBConnector(): DBConnector
    {
        $dbc = new DBConnector($this->type, $this->host, $this->port, $this->dbName);
        $dbc->connect($this->username, $this->password);
        return $dbc;
    }
}