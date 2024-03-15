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
                
                // запускаем перебор всего массива в обратном порядке
                for($i=count($posts)-1; $i>=0; $i--) {
                    $logPostUser = $posts[$i][4];
                    $userName = mysqli_fetch_All(mysqli_query($mysql, "SELECT * FROM `users` WHERE `login` = '$logPostUser'"));
            ?>
            <!-- форма для лайков -->
            <form action="../backend/like.php" method="POST">
                <!-- передаём id поста -->
                <input type="hidden" name="id" value="<?=$posts[$i][0]?>">
                <input type="hidden" name="login" value="<?=$posts[$i][4]?>">
                <input type="hidden" name="emailUser" value="<?=$login?>">
                <input type="hidden" name="page" value="<?=$page?>">
                <!-- сам пост -->
                <div class="allPosts">
                    <div class="post">
                        <!-- дата -->
                        <div class="datePost">
                            <?=$posts[$i][1]?> 
                        </div>
                        <!-- сообщение поста -->
                        <a href="../user/?<?=$posts[$i][4]?>">
                            <div class="user" title="@<?=$posts[$i][4]?>">
                                <?php if ($userName[0][6] == NULL) { ?>
                                <img src="../img/avatar.png" alt="фото">
                                <?php }else { ?>
                                <img src="../img/<?=$userName[0][6]?>" alt="фото">
                                <?php } ?>


                                <span><?=$userName[0][1]?> <?=$userName[0][2]?></span>
                            </div>
                        </a>
                        <div class="text">
                            <?=$posts[$i][2]?>
                        </div>
                        <!-- лайки -->
                        <?php
                            $idP = $posts[$i][0];
                            $logLike = $posts[$i][4];
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


                                <p><?=$posts[$i][5]?></p>


                                
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
