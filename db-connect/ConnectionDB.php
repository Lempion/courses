<?php

class ConnectionDB
{
    private $host = '127.0.0.1';
    private $dbname = 'coursbd';
    private $login = 'root';
    private $password = '';

    public function connect()
    {
        $db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->login, $this->password);
        return $db;
    }
}