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
        include 'general/mainPanel1.php'
    ?>
    <!-- основной контент страницы -->
    <div class="mainContent">
        <div class="profile">
            <div class="user">
                <div class="avatar">
                    <img src="img/avatar.png" alt="">
                </div>
                <div class="man">
                    <p class="name">Иванов Иван Иванович</p>
                    <span class="nameDescr">Ученик 11А класса</span>
                    <br/>
                    <br/>
                    <br/>
                    <p class="descriptionUser">Описание:</p>
                    <span class="description">Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit. 
                        Maecenas vulputate cursus sagittis. </span>
                </div>
            </div>
        </div>
        <div class="decider"></div>
        <div class="events"></div>
    </div>
    <!-- Продолжение основы -->
    <?php
        include 'general/mainPanel2.php'
    ?>
</body>
</html>