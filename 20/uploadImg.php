<?php
session_start();

require '../database/ConnectionDB.php';

if (!$filesCheck = $_FILES['imagesdb']['tmp_name']){
    $_SESSION['ANSWER'] = ['ERROR' => 'Один из файлов не является картинкой'];
    header('Location:/20');
    exit();
}

foreach ($filesCheck as $key => $file) {
    if (!$img = getimagesize($file)){
        $_SESSION['ANSWER'] = ['ERROR' => 'Один из файлов не является картинкой'];
        header('Location:/20');
        exit();
    }else{
        $exec = substr(strstr($img['mime'], '/'), 1);

        $filename = uniqid() . ".$exec";

        $uploadfile = "../images/$filename";

        $arrImg[] = $filename;

        if (!move_uploaded_file($file, $uploadfile)) {

            $_SESSION['ANSWER'] = ['ERROR' => 'Ошибка загрузки в БД'];
            header('Location:/20');
            exit();

        }
    }
}


$database = new ConnectionDB();

$result = $database->uploadImage($arrImg);

$_SESSION['ANSWER'] = $result;
header('Location:/20');
exit();

