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
                    <p class="name"><?=$row['surname']?> <?=$row['name']?> <?=$row['patronymic']?></p>
                    <span class="nameDescr">Ученик <?=$row['class']?> класса</span>
                    <br/>
                    <br/>
                    <br/>
                    <p class="descriptionUser">Описание:</p>
                    <span class="description"><?=$row['description']?></span>
                </div>
                <div class="decider"></div>
            </div>
        </div>
        <div class="events"></div>
    </div>
    <!-- Продолжение основы -->
    <?php
        include 'general/mainPanel2.php'
    ?>
</body>
</html>