<?php

session_start();

require '../database/ConnectionDB.php';

$dataBase = new ConnectionDB();

if ($_POST['email'] && $_POST['password']){
    $result = $dataBase->regUser($_POST['email'],$_POST['password']);

    $_SESSION['ANSWER'] = $result;
}else{
    $_SESSION['ANSWER'] = ['ERROR'=>'Все поля не были заполнены'];
}

header('Location:/13');

?>