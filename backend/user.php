<!-- основной бекенд профиля -->
<?php
    $email = 'admin@mail.ru';
    include '../db.php';
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
        header("Location: ../")
?>