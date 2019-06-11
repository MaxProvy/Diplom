<?php
require_once "config.php";
$sql = "SELECT * FROM `menu`";
$sqll = "SELECT * FROM `menu_sub`";

$result = $db->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

$result = $db->query($sqll);
while ($row = mysqli_fetch_assoc($result)) {
    $subitems[] = $row;
}
?>

<header>
    <ul class="menu">

        <?php
        foreach ($items as $item) {
            $menuname = $item['name'];
            $href = $item['href'];

            if (!empty($item['href'])) {
                echo "<li><a href='$href'>$menuname</a></li>";
            } else {
                echo "<li><a>$menuname</a><ul>";

                foreach ($subitems as $subitem) {

                    if ($item['id'] == $subitem['sub_id']) {
                        $subname = $subitem['name'];
                        $href = $subitem['href'];
                        echo "<li><a href='$href'>$subname</a></li>";
                    }
                }
                echo "</ul></li>";
            }
        }
        ?>

    </ul>
</header>