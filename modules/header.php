<?php
require_once "config.php";
$sql = "SELECT * FROM `menu`";

$result = $db->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}
?>

<header>
    <ul class="menu">

        <?php

        foreach ($items as $item) {
            $id = $item['id'];
            $menuname = $item['name'];
            $href = $item['href'];
//            echo "$id";


            $sql = "SELECT COUNT(*) FROM `menu_sub` WHERE `sub_id`=$id";
            $result = $db->query($sql);
            $row = mysqli_fetch_row($result);
            $total = $row[0]; // всего записей
//            echo $total;
            if ($total == 0) {
                echo "<li><a href='$href'>$menuname</a></li>";
            } else {
                $sql = "SELECT * FROM `menu_sub` WHERE `sub_id`=$id";
                $result = $db->query($sql);
                echo "<li><a>$menuname</a><ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $subname = $row['name'];
                    $href = $row['href'];
                    echo "<li><a href='$href'>$subname</a></li>";
                }
                echo "</ul></li>";
            }

        }
        ?>

    </ul>

    <div class="mobile">
        <div class="openmobile">
            <p>Показать меню</p>
        </div>
        <div class="punkts">
            <?php

            foreach ($items as $item) {
                $id = $item['id'];
                $menuname = $item['name'];
                $href = $item['href'];
//            echo "$id";


                $sql = "SELECT COUNT(*) FROM `menu_sub` WHERE `sub_id`=$id";
                $result = $db->query($sql);
                $row = mysqli_fetch_row($result);
                $total = $row[0]; // всего записей
//            echo $total;
                if ($total == 0) {
                    echo "<h3><a href='$href'>$menuname</a></h3>";
                } else {
                    $sql = "SELECT * FROM `menu_sub` WHERE `sub_id`=$id";
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
    </div>
</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    var a;
    $('body').on('click', '.openmobile', function () {
        if (a) {
            $('.punkts').css({"display": "none"});
            $('.openmobile p').text("Показать меню");
            a = false;
        } else {
            $('.punkts').css({"display": "block"});
            $('.openmobile p').text("Скрыть меню");
            a = true;
        }
    })
</script>