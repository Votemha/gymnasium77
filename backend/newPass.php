<?php
    session_start();
    include '../db.php';
    $email = $_SESSION['email'];
    $pass1 = $_POST['newPass1'];
    $pass2 = $_POST['newPass2'];
    $login = $mysql->query("SELECT `login` FROM `users` WHERE `email` = '$email'")->fetch_assoc()['login'];

    var_dump($pass1);

    if ($pass1 == $pass2) {
        $newPass = password_hash($pass1, PASSWORD_DEFAULT);
        $mysql->query("UPDATE `users` SET `password` = '$newPass' WHERE `email` = '$email'");
        setcookie('login', $login, time()+60*60*24*365*10, "/");
    } else {
        $_SESSION['ErrorSignUpNew'] = 'Пароли не совпадают';
    }
    header("Location: ../")
?>