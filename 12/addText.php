<?php

require '../database/ConnectionDB.php';

$dataBase = new ConnectionDB();

$result = $dataBase->addText('texts', 'text', $_POST['textdb']);

echo "<h1>$result</h1>";

?>