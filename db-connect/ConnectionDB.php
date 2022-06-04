<?php

class ConnectionDB
{
    private $host = '127.0.0.1';
    private $dbname = 'coursbd';
    private $login = 'root';
    private $password = '';
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->login, $this->password);
    }

    public function getTable($label)
    {
        $sql = "SELECT * FROM $label";

        $result = $this->db->query($sql);

        if ($result){
            $articles = $result->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return ['ERROR' => 'Ошибка получения данных'];
        }

        return $articles;

    }
}