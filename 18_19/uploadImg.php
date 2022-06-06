<?php
session_start();

$file = getimagesize($_FILES['imagesdb']['tmp_name']);

if (!$_FILES['imagesdb'] || !$file) {
    $_SESSION['ANSWER'] = ['ERROR' => 'Ошибка загрузки файла'];
    header('Location:/18_19');
    exit();
}

require '../database/ConnectionDB.php';

$database = new ConnectionDB();

//$preg = preg_match('%/.+%',$file['mime'],$matches);

//$fileMime = substr($matches[0],1,-1);

$exec = substr(strstr($file['mime'], '/'), 1);

$filename = uniqid() . ".$exec";

$uploadfile = "../images/$filename";

if (move_uploaded_file($_FILES['imagesdb']['tmp_name'], $uploadfile)) {
    $result = $database->uploadImage(array($filename));

    $_SESSION['ANSWER'] = $result;
    header('Location:/18_19');
    exit();
} else {
    $_SESSION['ANSWER'] = ['ERROR' => 'Ошибка загрузки в БД'];
    header('Location:/18_19');
    exit();
}
?>