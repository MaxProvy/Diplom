<?php
require_once 'modules/config.php';

//print_r($_GET);
if ($_GET['article']) {
    $method = 'article';
    $param = $_GET['article'];
    require_once 'modules/top.php';
    require_once 'modules/header.php';
    require_once 'modules/article.php';
    require_once 'modules/bot.php';
} else if ($_GET['pages']) {
    $method = 'page';
    $param = $_GET['pages'];
    require_once 'modules/top.php';
    require_once 'modules/header.php';
    require_once 'modules/article.php';
    require_once 'modules/bot.php';
} else if ($_GET['search']) {
//    echo "Страница поиска";
    $method = 'search';
    $param = $_GET['pages'];
    require_once 'modules/top.php';
    require_once 'modules/header.php';
    require_once 'modules/search.php';
    require_once 'modules/bot.php';
} else {
    require_once 'modules/top.php';
    require_once 'modules/slider.php';
    require_once 'modules/header.php';
    require_once 'modules/main.php';
    require_once 'modules/bot.php';
}