<?php
require_once 'config.php';

if (isset($_GET['m'])) {
    $m = $_GET['m'];
    $sql = "SELECT `id`,`name` FROM `$m` WHERE `name` <> ''";

    $result = $db->query($sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        };
        echo json_encode($arr);
    }

}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    $sql = "DELETE FROM `$table` WHERE `id` = $id";

    $result = $db->query($sql);

    if ($result) {
        echo json_encode(100);
    } else echo json_encode(404);

}



