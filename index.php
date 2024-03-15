<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="general/mainPanel.css">
    <link rel="stylesheet" href="profile/style.css">
    <title>Ваш профиль - Гимназия 77</title>
</head>
<body>
    <!-- Проверка на вход в аккаунт -->
    <?php
        include 'db.php';
        // откртие сессий
        session_start();

        $hasLogin = 1;
        if ($_COOKIE['login'] != NULL) {
            $login = $_COOKIE['login'];
        } else {
            $login = NULL;
        }
        
        $log = mysqli_query($mysql, "SELECT `login` FROM `users`");
        $log1 = mysqli_fetch_All($log);
        foreach ($log1 as $e) {
            if ($login == $e[0]) {
                $hasLogin *= 0;
            } else {
                $hasLogin *= 1;
            }
        }
        if ($hasLogin == 1) {
    ?>
    <!-- Если чеовек не вошёл в аккаунт -->
    <div class="sign">
        <div class="signUp">
            <p class="signText" id="signInText" style="display:none">Войти в аккаунт</p>
            <p class="signText" id="signUpText" style="display:block">Зарегистрироваться</p>
            <div class="content">

                <!-- Войти в аккаунт -->
                <form id="signIn" action="backend/signIn.php" method="POST" style="display:none">
                    <input type="text" name="login" placeholder="Логин">
                    <input type="password" name="password" placeholder="Пароль">
                    <div class="butSign"><button>войти</button></div>
                    <div class="textSign">
                        <p>Забыли пароль?</p>
                        <p id="signUpButton">Нет аккаунта? Зарегистрируйтесь!</p>
                        <p><?=$_SESSION['ErrorSignUp']?></p>
                    </div>
                </form>


                <!-- Зарегистрироваться -->
                <form id="signUp" action="backend/signUp.php" method="POST" style="display:block">

                    <input type="text" name="email" placeholder="Почта" required>
                    <input type="text" name="login" placeholder="Логин" required><br/>
                    <input type="text" name="name" placeholder="Имя" required>
                    <input type="text" name="surname" placeholder="Фамилия" required><br/>

                    <div class="numberClass">
                        <p>Класс</p>
                        <select type="number" name="numberClass" placeholder="Номер" required>
                            <option>1</optrion>
                            <option>2</optrion>
                            <option>3</optrion>
                            <option>4</optrion>
                            <option>5</optrion>
                            <option>6</optrion>
                            <option>7</optrion>
                            <option>8</optrion>
                            <option>9</optrion>
                            <option>10</optrion>
                            <option>11</optrion>
                        </select>
                        
                        <select type="text" name="letterClass" placeholder="Буква" required>
                            <option>А</optrion>
                            <option>Б</optrion>
                            <option>В</optrion>
                        </select>
                        <br/>
                    </div>

                    <input type="password" name="password1" placeholder="Пароль" required>
                    <input type="password" name="password2" placeholder="Повторите пароль" required>

                    <!-- кнопка -->
                        <div class="butSign" name="url" value="<?=$login?>">
                            <a href="/?votemha"><button>готово</button></a>
                        </div>

                    <div class="textSign">
                        <p id="signInButton">Есть аккаунт? Войдите!</p>
                        <span class="Error"><?=$_SESSION['ErrorSignUp']?></span>
                    </div>
                </form>

            </div>
        </div>

        <!-- скрипты авторизайции -->
        <script>
            const signUpButton = document.querySelector("#signUpButton");
            const signInButton = document.querySelector("#signInButton");
            const signUpText = document.querySelector("#signUpText");
            const signInText = document.querySelector("#signInText");
            const signUp = document.querySelector("#signUp");
            const signIn = document.querySelector("#signIn");

            signUpButton.addEventListener("click", function(e){
                signUp.style.display = "block";
                signIn.style.display = "none";
                signUpText.style.display = "block";
                signInText.style.display = "none";
            });
            signInButton.addEventListener("click", function(e){
                signIn.style.display = "block";
                signUp.style.display = "none";
                signInText.style.display = "block";
                signUpText.style.display = "none";
            });
        </script>


    </div>
    <!-- если человек вошёл в аккаунт -->
    <?php
        } else if ($hasLogin == 0) {
    ?>
    <!-- Основной контент страницы -->

    <!-- Основной класс стилей -->
    <?php
        // присвоение стиля выбраной страницы
        $profile = "this";
        $newsMobAdapt = "thisMod";

        // ссылки на другие страницы
        $profileClick = "";
        $recClick = "recommendation";
        $classClick = "";
        $scheduleClick = "";
        $newsClick = "";
        
        // подключение левой части страницы (нав бар + расписание)
        include 'general/mainPanel1.php';

        // Подключение файла update
        $_SESSION['update'] = "../fdgd";

        // временное подключение email пользователя
        $emailUser = $login;

        // достём все данные пользователя из базы данных
        $res = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
        $row = $res->fetch_assoc();
        $classBar = $row['numberClass'] . $row['letterClass'];
        $_SESSION['classBar'] = $classBar;

        $page = '../';
    ?>

    <!-- основной контент страницы -->
    <div class="mainContent">

        <div class="settingsImg"><img src="img/settings.png" alt=""></div>
                <div class="settings" style="display:none">
                    <!-- основной контент постов -->
                    <div class="content">
                        <!-- название -->
                        <div class="title">
                            <div class="cancelSettings">x</div>
                            <div class="textTitle"><p>Настройки</p></div>
                        </div>
                        <!-- сообщение -->
                        <div class="settingsContent">
                            <p>Сменить почту</p>
                            <span><img src="img/arrow.png" alt=">"></span>
                        </div>
                        <div class="settingsContent">
                            <p>Поменять пароль</p>
                            <span><img src="img/arrow.png" alt=">"></span>
                        </div>
                        <div class="settingsContent" id="styled">
                            <p>Тема</p>
                            <span><img src="img/arrow.png" alt=">"></span>
                        </div>
                        <form action="backend/delete.php" method="POST">
                            <div class="outContent">
                                <p>Выйти из аккаунта</p>
                                <button type="submit">выйти</button>
                            </div>
                        </form>

                        <input type="hidden" name="login" value="<?=$login?>">
                    </div>
                </div>

                <script>

                    // настройки
                    const settings = document.querySelector(".settings");
                    const settingsImg = document.querySelector(".settingsImg");
                    const cancelSettings = document.querySelector(".cancelSettings");
                    settingsImg.addEventListener("click", function(e) {
                        settings.style.display = "flex";
                    });
                    cancelSettings.addEventListener("click", function(e) {
                        settings.style.display = "none";
                    });
                </script>

        <div class="profile">
            <div class="user">
                <!-- аватарка -->
                <!-- проверка наличия фото -->
                <div class="avatar">
                    <?php
                        if ($row['photo'] == NULL) {
                    ?>
                        <img src="img/avatar.png" alt="фото профиля">
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
                    <button class="pencil"><img src="../img/pencil.png" alt="изменить данные профиля" title="изменить данные профиля"></button>
                    
                    <form action="" method="post">
                        <div class="name"><input id="surname" name="surname" type="text" value="<?=$row['surname']?>" placeholder="фамилия" style="outline:none;" readonly>
                        <input id="name" name="name" type="text" value="<?=$row['name']?>" placeholder="имя" style="outline:none;" readonly></div>
                        <span class="nameDescr">Ученик <span id="classUnchange" style="display:auto"><?=$row['numberClass']?><?=$row['letterClass']?></span>
                            <select id="classChange1" placeholder="<?=$row['numberClass']?>" type="number" name="numberClass" style="display:none" required>
                                <option>1</optrion>
                                <option>2</optrion>
                                <option>3</optrion>
                                <option>4</optrion>
                                <option>5</optrion>
                                <option>6</optrion>
                                <option>7</optrion>
                                <option>8</optrion>
                                <option>9</optrion>
                                <option>10</optrion>
                                <option>11</optrion>
                            </select>
                            
                            <select id="classChange2" value="<?=$row['letterClass']?>" type="text" name="letterClass" placeholder="Буква" style="display:none" required>
                                <option>А</optrion>
                                <option>Б</optrion>
                                <option>В</optrion>
                            </select> 
                        класса</span>
                        <br/>
                        <br/>
                        <br/>
                        <p class="descriptionUser">Описание:</p>
                        <span class="description"><textarea id="descr" name="descr" type="text" style="outline:none;" readonly><?=$row['description']?></textarea></span>
                        <button class="buttonOk" style="display: none">Сохранить</button> <div id="cancel" style="display: none;">X</div>
                    </form>
                
                </div>
                <!-- основной бекенд профиля -->
                <?php
                    // создание переменных профиля
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $cl = $_POST['cl'];
                    $descr = $_POST['descr'];
                    $numberClass = $_POST['numberClass'];
                    $letterClass = $_POST['letterClass'];
                    $descrOld = $mysql->query("SELECT `description` FROM  `users` WHERE `login` = '$login'");
                    if ($name != "") {
                        $mysql->query("UPDATE `users` SET  `name` = '$name' WHERE `login` = '$login'");
                    }
                    if ($surname != "") {
                        $mysql->query("UPDATE `users` SET  `surname` = '$surname' WHERE `login` = '$login'");
                    }
                    if ($cl != "") {
                        $mysql->query("UPDATE `users` SET  `class` = '$cl' WHERE `login` = '$login'");
                    }
                    if ($descr != "") {
                        $mysql->query("UPDATE `users` SET  `description` = '$descr' WHERE `login` = '$login'");
                    }
                    if ($numberClass != "" && $letterClass != "") {
                        $mysql->query("UPDATE `users` SET  `numberClass` = '$numberClass' WHERE `login` = '$login'");
                        $mysql->query("UPDATE `users` SET  `letterClass` = '$letterClass' WHERE `login` = '$login'");
                    }
                    
                ?>




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
                            <button name="del" type="submit" class="del"><img src="img/del.png" alt="удалить" title="удалить"></button>
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
        const descr = document.querySelector("#descr");
        const buttonOk = document.querySelector(".buttonOk");
        const cancel = document.querySelector("#cancel");
        const classUnchange = document.querySelector("#classUnchange");
        const classChange1 = document.querySelector("#classChange1");
        const classChange2 = document.querySelector("#classChange2");

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
            change(descr)
            buttonOk.style.display = "block"
            cancel.style.display = "block"
            classUnchange.style.display = "none"
            classChange1.style.display = ""
            classChange2.style.display = ""
	    });
        // изменения при нажатии на крестик
        cancel.addEventListener("click", function(e) {
            unChange(name)
            unChange(surname)
            unChange(descr)
            buttonOk.style.display = "none"
            cancel.style.display = "none"
            classUnchange.style.display = ""
            classChange1.style.display = "none"
            classChange2.style.display = "none"
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
        include 'general/mainPanel2.php';
    }
    ?>

</body>
</html>