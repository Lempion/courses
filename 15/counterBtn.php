<?php
session_start();

if ($_SESSION['COUNTER']){
$result = intval($_SESSION['COUNTER']) + 1;

    $_SESSION['COUNTER'] = $result;
}else{
    $_SESSION['COUNTER'] = 1;
}

header('Location:/15');

?>
