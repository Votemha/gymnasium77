<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="general/mainPanel.css">
    <link rel="stylesheet" href="profile/style.css">
    <title>Ваш профиль - Гимназия 77</title>
</head>
<body>
    <!-- Основной контент страницы -->

    <!-- Основной класс стилей -->
    <?php
        // откртие сессий
        session_start();

        // присвоение стиля выбраной страницы
        $profile = "this";

        // ссылки на другие страницы
        $profileClick = "";
        $classClick = "";
        $scheduleClick = "";
        $newsClick = "";
        $eventClick = "event";
        // подключение левой части страницы (нав бар + расписание)
        include 'general/mainPanel1.php';

        // Подключение файла update
        $_SESSION['update'] = "../fdgd";

        // временное подключение email пользователя
        $email = 'admin@mail.ru';

        // достём все данные пользователя из базы данных
        $res = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $row = $res->fetch_assoc();
    ?>

    <!-- основной контент страницы -->
    <div class="mainContent">

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
                        <div class="name"><input id="surname" name="surname" type="text" value="<?=$row['surname']?>" style="outline:none;" readonly onkeydown="this.style.width = ((this.value.length + 2) * 20) + 'px';">
                        <input id="name" name="name" type="text" value="<?=$row['name']?>" style="outline:none;" readonly onkeydown="this.style.width = ((this.value.length + 2) * 20) + 'px';"></div>
                        <span class="nameDescr">Ученик <input id="cl" name="cl" type="text" value="<?=$row['class']?>" style="outline:none;" onkeydown="this.style.width = ((this.value.length + 2) * 20) + 'px';" readonly> класса</span>
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
                    if ($name != "") {
                        $mysql->query("UPDATE `users` SET  `name` = '$name' WHERE `email` = '$email'");
                    }
                    if ($surname != "") {
                        $mysql->query("UPDATE `users` SET  `surname` = '$surname' WHERE `email` = '$email'");
                    }
                    if ($cl != "") {
                        $mysql->query("UPDATE `users` SET  `class` = '$cl' WHERE `email` = '$email'");
                    }
                    if ($descr != "") {
                        $mysql->query("UPDATE `users` SET  `description` = '$descr' WHERE `email` = '$email'");
                    } else {
                        $descr = "-";
                        $mysql->query("UPDATE `users` SET  `description` = '$descr' WHERE `email` = '$email'");
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
            <div class="allPosts"></div>
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
        
    </script>

    <!-- Продолжение основы -->
    <?php
        include 'general/mainPanel2.php';
    ?>
</body>
</html>