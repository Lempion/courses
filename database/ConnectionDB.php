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
        $sql = $this->db->prepare("SELECT * FROM $labelTable WHERE $fieldName = ?");

        $sql->execute(array($text));

        $result = $sql->fetchColumn();

        if ($result) {
            return ['ERROR' => 'You should check in on some of those fields below.'];
        }

        $resultAddText = $this->addText($labelTable, $fieldName, $text);

        return ['ACCEPT' => $text];
    }

    public function regUser($email, $password)
    {
        $sql = $this->db->prepare("SELECT `email` FROM `regusers` WHERE `email` = ?");
        $sql->execute(array($email));

        $user = $sql->fetchColumn();

        if ($user) {
            return ['ERROR' => 'Этот эл адрес уже занят другим пользователем'];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = $this->db->prepare("INSERT INTO `regusers` (`email`,`password`) VALUES (:email,:password)");

        $sql->execute(['email' => $email, 'password' => $passwordHash]);

        return ['ACCEPT' => 'Пользователь зарегистрирован'];
    }

    public function authUser($email, $password){
        $sql = $this->db->prepare("SELECT * FROM `regusers` WHERE `email` = ?");

        $sql->execute(array($email));

        $user = $sql->fetchAll();

        return $user;

    }

}