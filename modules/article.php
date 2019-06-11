<div class="medim">
    <?php
    require_once 'config.php';
    include_once 'verticalMenu.php';
    //    echo 'Param:' . $param;
    if ($method == 'article') {
        $sql = "SELECT * FROM `article` WHERE id=$param";

        $adres = $_SERVER['DOCUMENT_ROOT'] . "./img/articles/$param";
//        $adres = "yamax17j.beget.tech" . "/img/articles/$param";

        if (is_dir($adres)) {
//            echo "Эта папка существует";
            $childrens = new DirectoryIterator("./img/articles/$param");
            $imgs = true;
        }

    } else {
        $sql = "SELECT * FROM `page` WHERE id=$param";

        if (is_dir($_SERVER['DOCUMENT_ROOT'] . "./img/pages/$param")) {
//        echo "Эта папка существует";
            $childrens = new DirectoryIterator("./img/pages/$param");
            $imgs = true;
        }
    }

    $result = $db->query($sql);
    $row = mysqli_fetch_assoc($result);
    //    print_r($row);

    ?>
    <main>
        <div class="article-part">
            <div class="text">
                <div class="article-header">
                    <h2><?php echo $row['name'] ?></h2>
                    <div class="article-meta"><?php echo substr($row['date'], 0, 10); ?></div>
                </div>
                <div class="article-content">
                    <?php echo $row['text'] ?>
                </div>
                <div class="images">

                    <?php
                    echo "<span class='methart'>$method</span>";
                    echo "<span class='numart'>$param</span>";
                    # Обходим все объекты файлов
                    if ($imgs) {
                        foreach ($childrens as $children) {
                            # Если объект - файл
                            if ($children->isFile()) {
//                            echo $children->getFilename();
                                $dis = $row['dis'];
                                $img = $children->getFilename();
                                if ($method == 'article') {
                                    echo "<div class='img'><img class='image' src='/img/articles/$param/$img' alt='$dis'></div>";
                                } else {
                                    echo "<div class='img'><img class='image' src='/img/pages/$param/$img' alt='$dis'></div>";
                                }

                            }
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="intresting">
                <h4>Интересное</h4>
                <div class="article-list-sm">
                    <?php
                    $sql = "SELECT `id`,`name`,`dis` FROM `article` WHERE `name`<>'' ORDER BY `id` DESC LIMIT 3";
                    $result = $db->query($sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $des = $row['dis'];
                            echo "<div class='article-item-sm'><a href='?article=$id'>$name</a>$des</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>