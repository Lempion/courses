<?php
session_start();

require '../database/ConnectionDB.php';

$dataBase = new ConnectionDB();

$result = $dataBase->addTextUniq('texts', 'text', $_POST['textdb']);

$_SESSION['ANSWER'] = $result;

header('Location:/14');

?>