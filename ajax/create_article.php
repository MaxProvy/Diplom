<?php
require_once 'config.php';

$id = $_POST['id'];
$title = $_POST['title'];
$des = $_POST['description'];
$text = $_POST['text'];

//$sql = "UPDATE `article` SET `name` = '$title', `dis` = '$des', `text` = '$text' WHERE `article`.`id` = '$id'";
$sql = "INSERT INTO `article` (`date`, `name`, `dis`, `text`) VALUES (CURRENT_TIMESTAMP, '$title', '$des', '$text')";

$result = $db->query($sql);

if ($result) {
    echo json_encode($res = 'Статья номер ' . $id . ' создана');
}
