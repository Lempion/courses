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

    public function getTable($labelTable)
    {
        $sql = "SELECT * FROM $labelTable";

        $result = $this->db->query($sql);

        if ($result) {
            $articles = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return ['ERROR' => 'Ошибка получения данных'];
        }

        return $articles;

    }

    public function addText($labelTable, $fieldName, $text)
    {
        $sql = "INSERT INTO $labelTable ($fieldName) VALUES ('$text')";

        $result = $this->db->exec($sql);

        return $result;
    }

    public function addTextUniq($labelTable, $fieldName, $text)
    {
        $sql = "SELECT * FROM $labelTable WHERE $fieldName = $text";

        $result = $this->db->query($sql);

        return $result;
    }

}