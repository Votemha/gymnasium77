<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/mainPanel.css">
    <link rel="stylesheet" href="style.css">
    <title>Рекомендации</title>
</head>
<body>
    <?php  
        session_start();
        include '../db.php';
        // присвоение стиля выбраной страницы
        $rec = "this";

        // ссылки на другие страницы
        $profileClick = "../";
        $recClick = "";
        $classClick = "";
        $scheduleClick = "";
        $newsClick = "";
        
        // подключение левой части страницы (нав бар + расписание)
        include '../general/mainPanel1.php';
        $page = '../recommendation';
        if ($_COOKIE['login'] != NULL) {
            $login = $_COOKIE['login'];
        } else {
            $login = NULL;
        }
    ?>
    <!-- основной контент страницы -->
    <div class="mainContent">
        <!-- посты на странице -->
        <?php
                // получаем все посты и превращаем их в матричный массив
                $posts = mysqli_fetch_All(mysqli_query($mysql, "SELECT * FROM `posts`"));

                $rec = [];

                for($i=count($posts)-1; $i>=0; $i--) {
                    $logPostUser = $posts[$i][0];
                    if ($posts[$i][5] >= 0) {
                        $likesPostUser = $posts[$i][5] * 10;
                    } else {
                        $likesPostUser = abs($posts[$i][5]) * 3;
                    }
                    mb_internal_encoding("UTF-8");
                    $datePostUser = mb_substr($posts[$i][1], 5);
                    $datePostUser = explode('.', $datePostUser);
                    if ($datePostUser[2] == date('y')) {
                        if ($datePostUser[1] == date('n')) {
                            $dateRecPostUser = date('j') - $datePostUser[0] * 5;
                        } else {
                            $dateRecPostUser = date('n') - $datePostUser[1] * 3;
                        }
                    } else {
                        if (date('y') - $datePostUser[2] >= 2) {
                            $dateRecPostUser = 0;
                            
                        } else {
                            $dateRecPostUser = (date('y') - $datePostUser[2]) * 1.2;
                            
                        }
                    }
                    $recSumPostUser = abs($likesPostUser) + abs($dateRecPostUser);
                    array_push($rec, array($logPostUser, $recSumPostUser));
                }
                foreach ($rec as $key => $row) {
                    $rec_name[$key] = $row[1];
                }
                array_multisort($rec_name, SORT_ASC, $rec);
                $rec = array_reverse($rec, true);

                // запускаем перебор всего массива в обратном порядке
                foreach($rec as $post) {
                    $idPost = $post[0];
                    $postRec = $mysql->query("SELECT * FROM `posts` WHERE `id` = '$idPost'")->fetch_assoc();
                    $logPostUser = $postRec['login'];
                    $userName = $mysql->query("SELECT * FROM `users` WHERE `login` = '$logPostUser'")->fetch_assoc();
            ?>
            <!-- форма для лайков -->
            <form action="../backend/like.php" method="POST">
                <!-- передаём id поста -->
                <input type="hidden" name="id" value="<?=$postRec['id']?>">
                <input type="hidden" name="login" value="<?=$postRec['login']?>">
                <input type="hidden" name="emailUser" value="<?=$login?>">
                <input type="hidden" name="page" value="<?=$page?>">
                <!-- сам пост -->
                <div class="allPosts">
                    <div class="post">
                        <!-- дата -->
                        <div class="datePost">
                            <?=$postRec['date']?> 
                        </div>
                        <!-- сообщение поста -->
                        <a href="../user/?<?=$postRec['login']?>">
                            <div class="user" title="@<?=$postRec['login']?>">
                                <?php if ($userName['photo'] == NULL) { ?>
                                <img src="../img/avatar.png" alt="фото">
                                <?php }else { ?>
                                <img src="../img/<?=$userName['photo']?>" alt="фото">
                                <?php } ?>


                                <span><?=$userName['name']?> <?=$userName['surname']?></span>
                            </div>
                        </a>
                        <div class="text">
                            <?=$postRec['message']?>
                        </div>
                        <!-- лайки -->
                        <?php
                            $idP = $postRec['id'];
                            $logLike = $postRec['login'];
                            // получаем список пользователей, которые поставили лайк, дизлайк
                            $allUserLike = explode(";", $mysql->query("SELECT `usersLike` FROM `posts` WHERE `login` = '$logLike' AND `id` = '$idP'")->fetch_assoc()['usersLike']);
                            $allUserDislike = explode(";", $mysql->query("SELECT `usersDislike` FROM `posts` WHERE `login` = '$logLike' AND `id` = '$idP'")->fetch_assoc()['usersDislike']);
                            
                            // счётчик есть ли человек в списке
                            // тех кто лайкнул
                            $a = 1;
                            // тех кто дизлайкнул
                            $e = 1;

                            // перебераем список всех пользователей, которые поставли лайк
                            foreach($allUserLike as $login1) {
                                // сравниваем пользователя со списком
                                // если такого нет, то умножаем счётчик на 1
                                if ($login1 != $login) {
                                    $a *= 1;
                                // в обратном же случае умножаем на 0
                                } else {
                                    $a *= 0;
                                }
                            }
                            // перебераем список всех пользователей, которые поставли дизлайк
                            foreach($allUserDislike as $login2) {
                                // сравниваем пользователя со списком
                                // если такого нет, то умножаем счётчик на 1
                                if ($login2 != $login) {
                                    $e *= 1;
                                // в обратном же случае умножаем на 0
                                } else {
                                    $e *= 0;
                                }
                            }
                        ?>
                        <div class="bottomPost">
                            <div class="like">
                                <?php
                                    // если человека нет в списке лайкнувших (счётчик $a равен 1), то
                                    if ($a == 1) {
                                    // рисуем кноку лайка ненажатую
                                ?>
                                <button name="like" id="plus">+</button>
                                <?php
                                    // в обратном же случае
                                    } else {
                                    // рисуем кноку лайка нажатую
                                ?>
                                <button name="likePressed" id="plusPressed">+</button>
                                <?php
                                    }
                                ?>


                                <p><?=$postRec['likes']?></p>


                                
                                <?php
                                    // если человека нет в списке дизлайкнувших (счётчик $e равен 1), то
                                    if ($e == 1) {
                                    // рисуем кноку дизлайка ненажатую
                                ?>
                                <button name="dislike" id="minus">-</button>
                                <?php
                                    // в обратном же случае
                                    } else {
                                    // рисуем кноку лайка нажатую
                                ?>
                                <button name="dislikePressed" id="minusPressed">-</button>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                }
            ?>
    </div>

    <!-- скрипты -->

    <!-- Продолжение основы -->
    <?php
        include '../general/mainPanel2.php';
    ?>
</body>
</html>
