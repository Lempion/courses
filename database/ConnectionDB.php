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

    public function authUser($email, $password)
    {
        $sql = $this->db->prepare("SELECT * FROM `regusers` WHERE `email` = ?");

        $sql->execute(array($email));

        $user = $sql->fetchAll();

        if (!$user) {
            return ['ERROR' => "Пользователь $email не зарегистрирован"];
        }

        $checkPass = password_verify($password, $user[0]['password']);

        if (!$checkPass) {
            return ['ERROR' => "Логин или пароль введён не верно"];
        }


        return ['ACCEPT' => $email];


    }

    public function uploadImage($labelImg)
    {
        $sql = $this->db->prepare("INSERT INTO `files` (`label`) VALUES (:label)");

        $result = $sql->execute(['label' => $labelImg]);

        if ($result) {
            return ['ACCEPT' => 'Картинка успешно загружена'];
        } else {
            return ['ERROR' => 'Ошибка загрузки файла в БД'];
        }
    }

    public function getImages()
    {
        $sql = "SELECT * FROM `files`";

        $result = $this->db->query($sql);

        if ($result) {
            $labels = $result->fetchAll(PDO::FETCH_ASSOC);
            return $labels;
        } else {
            return ['ERROR' => 'Ошибка получения данных из БД'];
        }
    }

    public function removeImages($id)
    {

        $sql = $this->db->prepare("SELECT * FROM `files` WHERE `id`=?");
        $sql->execute(array($id));

        if ($sql) {
            $dataImg = $sql->fetchAll(PDO::FETCH_ASSOC);

            $idImg = $dataImg[0]['id'];
            $labelImg = $dataImg[0]['label'];

            $sql = $this->db->prepare("DELETE FROM `files` WHERE `id`=?");
            $sql->execute(array($idImg));

            unlink("../18_19/images/$labelImg");

//            return ['sql' => $sql, 'id' => $idImg, 'path' => "../18_19/images/$labelImg", 'data' => $dataImg];
            return ['ACCEPT'=>'Картинка удалена'];

        } else {
            return ['ERROR' => 'Ошибка удаления из БД'];
        }
    }

}