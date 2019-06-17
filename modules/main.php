<div class="medim">
    <?php
    require_once 'config.php';
    include_once 'verticalMenu.php';

    $sql = "SELECT COUNT(*) FROM `article`";
    $result = $db->query($sql);
    $row = mysqli_fetch_row($result);
    $total = $row[0]; // всего записей

    $kol = 16;  //количество записей для вывода
    if (isset($_GET['page']) AND $_GET['page'] > 0) {
        $page = $_GET['page'];
    } else $page = 1;

    $str_pag = ceil($total / $kol);

    if ($page > $str_pag) {
        $page = 1;
    }

    $art = ($page * $kol) - $kol; // определяем, с какой записи нам выводить

    ?>
    <main>
        <div class="article-list">
            <?php
            $sql = "SELECT `id`,`date`,`name`,`dis` FROM `article` ORDER BY `id` DESC LIMIT $art,$kol";

            //            print_r($sql);
            $result = $db->query($sql);
            while ($row = mysqli_fetch_assoc($result)):
                $id = $row['id'];

                if ($row['name'] != '') {

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
                }
            endwhile;
            ?>
        </div>
        <div class="pagination">
            <?php
            $page -= 1;
            echo "<a href='?page=$page'>Предыдущая</a>";
            $page += 1;
            echo "<p>Текущая страница - $page</p>";

            $page += 1;

            echo "<a href='?page=$page'>Следующая</a>";
            ?>
        </div>
        <?php
        include_once 'verticalMobile.php';
        ?>
    </main>
</div>