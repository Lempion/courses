<?php

$file = getimagesize($_FILES['imagesdb']['tmp_name']);

if (!$file) {
    return ['ERROR' => 'Файл не является изображением'];
}

require '../database/ConnectionDB.php';

$database = new ConnectionDB();

//$preg = preg_match('%/.+%',$file['mime'],$matches);

//$fileMime = substr($matches[0],1,-1);

$exec = substr(strstr($file['mime'], '/'), 1);

$filename = uniqid() . ".$exec";

$uploadfile = "../18/images/$filename";

if (move_uploaded_file($_FILES['imagesdb']['tmp_name'], $uploadfile)) {
    echo '<pre>';
    print_r($_FILES['imagesdb']);
    print_r($file);
    print_r($filename);
    echo '</pre>';
} else {
    return ['ERROR' => 'Ошибка загрузки'];
}


?>