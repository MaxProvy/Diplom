<?php

require_once 'config.php';

$data = array();

if (isset($_GET['uploadfiles'])) {
//    print_r($_GET);
    if (empty($_GET['uploadfiles'])) {
//        Значит надо добавить статью
        $sql = "INSERT INTO `page` (`name`, `text`) VALUES ('', '')";
//        echo $sql;
        $result = $db->query($sql);
        $papka = $db->insert_id;
    } else {
        $papka = $_GET['uploadfiles'];
    };

    $kol = $_GET['article_kol'];

    $error = false;
    $files = array();

    $uploaddir = '../img/pages/' . $papka . '/';

// Создадим папку если её нет

    if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);

// переместим файлы из временной директории в указанную
    foreach ($_FILES as $file) {
        $filename = $kol++ . '.' . end(explode(".", basename($file['name'])));
        if (move_uploaded_file($file['tmp_name'], $uploaddir . $filename)) {
            $files[] = '/img/pages/' . $papka . '/' . $filename;
        } else {
            $error = true;
        }
    }

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files, 'id' => $papka, 'kol' => $kol);

    echo json_encode($data);
}