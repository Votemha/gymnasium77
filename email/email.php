<?php
    session_start();
    include '../db.php';
    $email = $_POST['email'];
    $codeHash = $_SESSION['codeEmail'];
    $codeUser = $_POST['codeUser'];
    $login = $_SESSION['login'];
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $numberClass = $_SESSION['numberClass'];
    $letterClass = $_SESSION['letterClass'];
    $surname = $_SESSION['surname'];
    $numberClass = $_SESSION['numberClass'];
    $password = $_SESSION['password'];

    if (password_verify($codeUser, $codeHash)) {
        setcookie('login', $login, time()+60*60*24*365*10, "/");
        $mysql->query("INSERT INTO `users` (`name`, `surname`, `numberClass`, `letterClass`, `email`, `login`, `password`) VALUES('$name', '$surname', '$numberClass', '$letterClass', '$email', '$login', '$password')");
        header("Location: ../");
    } else {
        $_SESSION['ErrorSignUp'] = "Не правильный код";
        header("Location: ../email");
    }
?>