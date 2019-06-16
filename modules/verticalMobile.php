<div class="mobilemenu">

    <?php

    require_once "config.php";
    $sql = "SELECT * FROM `l_menu`";

    $items = array();

    $result = $db->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }

    foreach ($items as $item) {
        $id = $item['id'];
        $menuname = $item['name'];
        $href = $item['href'];
//            echo "$id";


        $sql = "SELECT COUNT(*) FROM `l_menu_sub` WHERE `sub_id`=$id";
        $result = $db->query($sql);
        $row = mysqli_fetch_row($result);
        $total = $row[0]; // всего записей
//            echo $total;
        if ($total == 0) {
            echo "<h3><a href='$href'>$menuname</a></h3>";
        } else {
            $sql = "SELECT * FROM `l_menu_sub` WHERE `sub_id`=$id";
            $result = $db->query($sql);
            echo "<h3><a>$menuname</a></h3>";
            while ($row = mysqli_fetch_assoc($result)) {
                $subname = $row['name'];
                $href = $row['href'];
                echo "<a href='$href'>$subname</a>";
            }
        }

    }

    ?>

</div>
