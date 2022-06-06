<?php

if (!$_GET['id'] && gettype($_GET['id']) !== 'integer') {
    header('Location:/20');
    $_SESSION['ANSWER'] = ['ERROR' => 'Переданы не верные данные'];
    exit();
}

session_start();

require '../database/ConnectionDB.php';

$database = new ConnectionDB();

$result = $database->removeImages($_GET['id']);

$_SESSION['ANSWER'] = $result;

header('Location:/20');
?>