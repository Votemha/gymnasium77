<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/mainPanel.css">
    <link rel="stylesheet" href="style.css">
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
        $event = "this";
        $profileClick = "../";
        $classClick = "";
        $scheduleClick = "";
        $newsClick = "";
        $eventClick = "";
        include '../general/mainPanel1.php'
    ?>
    <!-- основной контент страницы -->
    <div class="mainContent">
        что-то здесь
    </div>
    <!-- Продолжение основы -->
    <?php
        include '../general/mainPanel2.php'
    ?>
</body>
</html>