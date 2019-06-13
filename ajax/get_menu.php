<?php
require_once 'config.php';

$sql = "SELECT * FROM `menu`";

$result = $db->query($sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    };
    echo json_encode($arr);
}

