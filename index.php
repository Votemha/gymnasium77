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
    <?php
        $main = '<div class="mainContent">что-то</div>';
    ?>
    <!-- Основной класс стилей -->
    <?php
        // переменные для основы
        $profile = "this";
        $profileClick = "";
        $classClick = "";
        $scheduleClick = "";
        $newsClick = "";
        $eventClick = "event";
        include 'general/mainPanel1.php';

        $email = 'admin@mail.ru';

        $res = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $row = $res->fetch_assoc();
    ?>

    <!-- основной контент страницы -->
    <div class="mainContent">
        <div class="profile">
            <div class="user">
                <div class="avatar">
                    <?php
                        if ($row['photo'] == NULL) {
                    ?>
                        <img src="img/avatar.png" alt="">
                    <?php
                        } else {
                    ?>
                        <img src="<?=$row['photo']?>" alt="">
                    <?php
                        }
                    ?>
                </div>
                <div class="man">
                     <button class="pencil"><img src="../img/pencil.png" alt=""></button>
                    <form action="" method="post">
                        <p class="name"><input id="name" name="name" type="text" value="<?=$row['surname']?> <?=$row['name']?> <?=$row['patronymic']?>" style="outline:none;" readonly></p>
                        <span class="nameDescr">Ученик <input id="cl" name="cl" type="text" value="<?=$row['class']?>" style="outline:none;" readonly> класса</span>
                        <br/>
                        <br/>
                        <br/>
                        <p class="descriptionUser">Описание:</p>
                        <span class="description"><textarea id="descr" name="descr" type="text" style="outline:none;" readonly><?=$row['description']?></textarea></span>
                        <button class="buttonOk" style="display: none">Сохранить</button> <div id="cancel" style="display: none;">X</div>
                    </form>
                </div>
                <div class="decider"></div>
            </div>
        </div>
        <div class="events"></div>
    </div>

    <script>
        const pencil = document.querySelector(".pencil");
        const name = document.querySelector("#name");
        const cl = document.querySelector("#cl");
        const descr = document.querySelector("#descr");
        const buttonOk = document.querySelector(".buttonOk");
        const cancel = document.querySelector("#cancel");
        function change(e) {
            e.style.outline = '2px solid';
            e.readOnly = false;
        }
        function unChange(e) {
            e.style.outline = 'none';
            e.readOnly = true;
        }
        pencil.addEventListener("click", function(e) {
            change(name)
            change(cl)
            change(descr)
            buttonOk.style.display = "block"
            cancel.style.display = "block"
	    });
        cancel.addEventListener("click", function(e) {
            unChange(name)
            unChange(cl)
            unChange(descr)
            buttonOk.style.display = "none"
            cancel.style.display = "none"
	    });
    </script>

    <!-- Продолжение основы -->
    <?php
        include 'general/mainPanel2.php'
    ?>
</body>
</html>