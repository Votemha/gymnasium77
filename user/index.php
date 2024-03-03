<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/mainPanel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../profile/style.css">
    <title>Профиль</title>
</head>
<body>
    <?php  
        include '../db.php';
        // присвоение стиля выбраной страницы

        // ссылки на другие страницы
        $profileClick = "../";
        $recClick = "../recommendation";
        $classClick = "";
        $scheduleClick = "";
        $newsClick = "";
        
        // подключение левой части страницы (нав бар + расписание)
        include '../general/mainPanel1.php';
        $page = '../recommendation';
        if ($_SERVER['REQUEST_URI'] != NULL) {
            $loginArray = explode('/', $_SERVER['REQUEST_URI']);
            mb_internal_encoding("UTF-8");
            $login = substr($loginArray[count($loginArray)-1], 1);
        } else {
            $login = NULL;
        }

        $emailUser = $_COOKIE['login'];

        // достём все данные пользователя из базы данных
        $row = mysqli_fetch_All(mysqli_query($mysql, "SELECT * FROM `users` WHERE `login` = '$login'"));

        $page = '../user';
    ?>

    <div class="mainContent">

        <div class="profile">
            <div class="user">
                <!-- аватарка -->
                <!-- проверка наличия фото -->
                <div class="avatar">
                    <?php
                        if ($row['photo'] == NULL) {
                    ?>
                        <img src="../img/avatar.png" alt="фото профиля">
                    <?php
                        } else {
                    ?>
                        <img src="<?=$row['photo']?>" alt="">
                    <?php
                        }
                    ?>
                </div>
                <!-- основные сведения о человеке -->
                <!-- всё это изначально форма, но её нельзя изменять, пока не нажать на карандаш -->
                <div class="man">
                    <!-- <button class="pencil"><img src="../img/pencil.png" alt="изменить данные профиля" title="изменить данные профиля"></button> -->
                    
                    <form action="" method="post">
                        <div class="name"><input id="surname" name="surname" type="text" value="<?=$row[0][2]?>" placeholder="фамилия" style="outline:none;" readonly>
                        <input id="name" name="name" type="text" value="<?=$row[0][1]?>" style="outline:none;" placeholder="имя" readonly></div>
                        <span class="nameDescr">Ученик <?=$row[0][3] . $row[0][4]?> класса</span>
                        <br/>
                        <br/>
                        <br/>
                        <p class="descriptionUser">Описание:</p>
                        <span class="description"><textarea id="descr" name="descr" type="text" style="outline:none;" readonly><?=$row[0][5]?></textarea></span>
                        <button class="buttonOk" style="display: none">Сохранить</button> <div id="cancel" style="display: none;">X</div>
                    </form>
                
                </div>




                <!-- разделитель -->
                <div class="decider"></div>
            </div>
        </div>





        <!-- посты -->
        <div class="posts">

            <div class="newPosts">
                <span>+</span><p>Новый пост...</p>
            </div>

            <form action="backend/posts.php" method="POST">
                <div class="popupPosts" style="display:none;">
                    <!-- основной контент постов -->
                    <div class="content">
                        <!-- название -->
                        <div class="title">
                            <div class="cancelPosts">x</div>
                            <div class="date"><?=$dateRu?></div>
                            <div class="textTitle"><p>Добавить новый пост</p></div>
                        </div>
                        <!-- сообщение -->
                        <div class="message">
                            <textarea class="messageText" name="message" placeholder="Сообщение..."></textarea>
                        </div>
                        <!-- отправить -->
                        <div class="send">
                            <div class="photo">
                                <img src="img/photo.png" alt="добавить фото" title="добавить фото">
                            </div>
                            <button class="publish">
                                опубликовать
                            </button>
                        </div>
                        <input type="hidden" name="datePop" value="<?=$dateRu?>">
                        <input type="hidden" name="login" value="<?=$login?>">
                    </div>
                </div>
            </form>
            
            
            <!-- посты на странице -->
            <?php
                // получаем все посты и превращаем их в матричный массив
                $posts = mysqli_fetch_All(mysqli_query($mysql, "SELECT * FROM `posts` WHERE `login` = '$login'"));
                
                // запускаем перебор всего массива в обратном порядке
                for($i=count($posts)-1; $i>=0; $i--) {
            ?>
            <!-- форма для лайков -->
            <form action="backend/like.php" method="POST">
                <!-- передаём id поста -->
                <input type="hidden" name="id" value="<?=$posts[$i][0]?>">
                <input type="hidden" name="login" value="<?=$login?>">
                <input type="hidden" name="emailUser" value="<?=$emailUser?>">
                <input type="hidden" name="page" value="<?=$page?>">
                <!-- сам пост -->
                <div class="allPosts">
                    <div class="post">
                        <!-- дата -->
                        <div class="datePost">
                            <?=$posts[$i][1]?> 
                        </div>
                        <!-- сообщение поста -->
                        <div class="text">
                            <?=$posts[$i][2]?>
                        </div>
                        <!-- лайки -->
                        <?php
                            $idP = $posts[$i][0];
                            // получаем список пользователей, которые поставили лайк, дизлайк
                            $allUserLike = explode(";", $mysql->query("SELECT `usersLike` FROM `posts` WHERE `login` = '$login' AND `id` = '$idP'")->fetch_assoc()['usersLike']);
                            $allUserDislike = explode(";", $mysql->query("SELECT `usersDislike` FROM `posts` WHERE `login` = '$login' AND `id` = '$idP'")->fetch_assoc()['usersDislike']);
                            
                            // счётчик есть ли человек в списке
                            // тех кто лайкнул
                            $a = 1;
                            // тех кто дизлайкнул
                            $e = 1;

                            // перебераем список всех пользователей, которые поставли лайк
                            foreach($allUserLike as $login1) {
                                // сравниваем пользователя со списком
                                // если такого нет, то умножаем счётчик на 1
                                if ($login1 != $emailUser) {
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
                                if ($login2 != $emailUser) {
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

    </div>


    




    <!-- скрипты -->
    <script>


        // user скрипты
        // создаю константы
        const pencil = document.querySelector(".pencil");
        const name = document.querySelector("#name");
        const surname = document.querySelector("#surname");
        const cl = document.querySelector("#cl");
        const descr = document.querySelector("#descr");
        const buttonOk = document.querySelector(".buttonOk");
        const cancel = document.querySelector("#cancel");

        // функция стилей при нажатии на карандаш
        function change(e) {
            e.style.outline = '2px solid rgba(0, 0, 0, 0.5)';
            e.readOnly = false;
        }
        // функция стилей при нажатии на крестик
        function unChange(e) {
            e.style.outline = 'none';
            e.readOnly = true;
        }
        // изменения при нажатии на карандаш
        pencil.addEventListener("click", function(e) {
            change(name)
            change(surname)
            change(cl)
            change(descr)
            buttonOk.style.display = "block"
            cancel.style.display = "block"
	    });
        // изменения при нажатии на крестик
        cancel.addEventListener("click", function(e) {
            unChange(name)
            unChange(surname)
            unChange(cl)
            unChange(descr)
            buttonOk.style.display = "none"
            cancel.style.display = "none"
	    });



        // посты 
        const newPosts = document.querySelector(".newPosts");
        const popupPosts = document.querySelector(".popupPosts");
        const cancelPosts = document.querySelector(".cancelPosts");
        newPosts.addEventListener("click", function(e) {
            popupPosts.style.display = "flex";
        });
        cancelPosts.addEventListener("click", function(e) {
            popupPosts.style.display = "none";
        });
        // лайки
        const like = document.querySelector(".like");
        const plus = document.querySelector("#plus");
        const minus = document.querySelector("#minus");
        plus.addEventListener("click", function(e) {
            popupPosts.style.display = "none";
        });
    </script>

    <!-- Продолжение основы -->
    <?php
        include '../general/mainPanel2.php';
    ?>
</body>
</html>