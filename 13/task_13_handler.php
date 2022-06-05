<?php

session_start();

require '../database/ConnectionDB.php';

$dataBase = new ConnectionDB();

$result = $dataBase->regUser();

$_SESSION['ANSWER'] = $result;

header('Location:/13');

?>