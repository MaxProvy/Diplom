<div class="medim">
    <?php
    include_once 'verticalMenu.php';

    $search = $_GET['search'];

    $sql = "SELECT * FROM `article` WHERE `name` LIKE '%$search%'
                  OR `text` LIKE '%$search%'
                  OR `dis` LIKE '%$search%'
                  AND `name` <>''
                  AND `text` <> ''
                  AND `dis` <> ''";

    ?>
    <main>
        <div class="article-list">
            <?php

            $flag = false;

            //            print_r($sql);
            $result = $db->query($sql);

            if ($result) {

                while ($row = mysqli_fetch_assoc($result)):
                    $id = $row['id'];

                    ?>

                    <div class="article-list-item">
                        <div class="previewimg"><img src="<?php
                            echo "img/articles/$id/1.jpg";
                            ?>" alt=""></div>
                        <div class="article-meta">
                            <?php echo substr($row['date'], 0, 10); ?>
                        </div>
                        <h3><?php echo $row['name'] ?></h3>
                        <p><?php echo $row['dis'] ?></p>
                        <a href="?article=<?php
                        $id = $row['id'];
                        $id = (int)$id;
                        echo $id;
                        ?>">Читать статью</a>
                    </div>
                    <?php
                    $flag = true;
                endwhile;

            } else 'Ошибка запроса';

            if (!$flag) echo "<div class=\"article-list-item\" style='max-width: fit-content'>По вашему поисковому запросу ничего не найдено. <a href='/'>На главную</a> </div>";

            ?>
        </div>
    </main>
</div>