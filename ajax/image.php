<?php

require_once 'config.php';

$data = array();

if (isset($_GET['uploadfile'])) {
//    print_r($_GET);
    if (empty($_GET['uploadfile'])) {
//        Значит надо добавить статью
        $sql = "INSERT INTO `article` (`name`, `dis`, `text`) VALUES ('', '', '')";
        $result = $db->query($sql);
        $papka = $db->insert_id;
    } else $papka = $_GET['uploadfile'];

    $error = false;
    $files = array();

    $uploaddir = '../img/articles/' . $papka . '/';

// Создадим папку если её нет

    if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);

// переместим файлы из временной директории в указанную
    foreach ($_FILES as $file) {
        $filename = '1.' . end(explode(".", basename($file['name'])));
        if (move_uploaded_file($file['tmp_name'], $uploaddir . $filename)) {
            $files[] = '/img/articles/' . $papka . '/' . $filename;
        } else {
            $error = true;
        }
    }

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files, 'id' => $papka);

    echo json_encode($data);
}