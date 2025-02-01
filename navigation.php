<?php

// изменить название у кнопки отправить в Тg
if(isset($_POST['post_tg_add'])) {

    // img
    $allowed_filetypes = array('jpg','gif','bmp','png'); 
    $upload_path = 'img/';
    $filename = $_FILES['photopost']['name']; 
    $ext = pathinfo($filename, PATHINFO_EXTENSION); 
    /*
    if(!in_array($ext,$allowed_filetypes)) { 
        die('Данный тип файла не поддерживается.');
    }
    move_uploaded_file($_FILES['photopost']['tmp_name'],$upload_path . $filename);
    */
    // сделать загрузку в БД
    // продумать как можно сделать выгрузку данных из БД или передачу между файлами
    // message
    $message = urlencode($_POST['message_tg']); 
    header("location: index.php?MODE=create_post_tg&message=$message");
    exit;
}

if(isset($_POST['post_vk_add'])) { 
    header("location: index.php?MODE=create_post_vk");
    exit;
}

// добавить проверку на кнопку ВК

// добавить проверку на кнопку ВК и ТГ

?>