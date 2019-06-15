<?php
require_once 'config.php';

if (isset($_GET)) {
    switch ($_GET['m']) {
        case 'get':
            $sql = "SELECT * FROM `menu`";

            $result = $db->query($sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $arr[] = $row;
                };
                echo json_encode($arr);
            }
            break;
        case 'postmenu':
            $name = $_POST['name'];
            $href = $_POST['href'];

            if (empty(preg_replace('/\s/', '', $href))) {
                $href = '/';
            }
            if (empty(preg_replace('/\s/', '', $name))) {
                echo json_encode('Поле не может быть пустым');
                exit();
            }

            $sql = "INSERT INTO `menu` ( `name`, `href`) VALUES ('$name', '$href')";

            $result = $db->query($sql);
            if ($result) {
                echo json_encode('Успешно создано');
            } else echo json_encode('Ошибка запроса к базе');


            break;
        case 'postsubmenu':

            $sub = $_POST['sub'];
            $name = $_POST['name'];
            $href = $_POST['href'];

            if (empty(preg_replace('/\s/', '', $name)) || empty(preg_replace('/\s/', '', $href))) {
                echo json_encode('Поле не может быть пустым');
                exit();
            }
            if ($sub == 0) {
                echo json_encode('Пункт меню не выбран');
                exit();
            }

            $sql = "INSERT INTO `menu_sub` (`sub_id`, `name`, `href`) VALUES ('$sub', '$name', '$href')";

            $result = $db->query($sql);
            if ($result) {
                echo json_encode('Успешно создано');
            } else echo json_encode('Ошибка запроса к базе');

            break;
        case 'lget':
            $sql = "SELECT * FROM `l_menu`";

            $result = $db->query($sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $arr[] = $row;
                };
                echo json_encode($arr);
            }
            break;
        case 'lpostmenu':
            $name = $_POST['name'];
            $href = $_POST['href'];

            if (empty(preg_replace('/\s/', '', $href))) {
                $href = '/';
            }
            if (empty(preg_replace('/\s/', '', $name))) {
                echo json_encode('Поле не может быть пустым');
                exit();
            }

            $sql = "INSERT INTO `l_menu` ( `name`, `href`) VALUES ('$name', '$href')";

            $result = $db->query($sql);
            if ($result) {
                echo json_encode('Успешно создано');
            } else echo json_encode('Ошибка запроса к базе');


            break;
        case 'lpostsubmenu':

            $sub = $_POST['sub'];
            $name = $_POST['name'];
            $href = $_POST['href'];

            if (empty(preg_replace('/\s/', '', $name)) || empty(preg_replace('/\s/', '', $href))) {
                echo json_encode('Поле не может быть пустым');
                exit();
            }
            if ($sub == 0) {
                echo json_encode('Пункт меню не выбран');
                exit();
            }

            $sql = "INSERT INTO `l_menu_sub` (`sub_id`, `name`, `href`) VALUES ('$sub', '$name', '$href')";

            $result = $db->query($sql);
            if ($result) {
                echo json_encode('Успешно создано');
            } else echo json_encode('Ошибка запроса к базе');

            break;
    }
}



