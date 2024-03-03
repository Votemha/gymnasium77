<?php
    session_start();
    include '../db.php';

    // переменные
    $email = $_POST['email'];
    $login = $_POST['login'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $numberClass = $_POST['numberClass'];
    $letterClass = $_POST['letterClass'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $loginsUser = mysqli_fetch_All(mysqli_query($mysql, "SELECT `login` FROM `users`"));
    $emailsUser = mysqli_fetch_All(mysqli_query($mysql, "SELECT 'email' FROM `users`"));
    $_SESSION['SuccessSignUp'] = "";
    $_SESSION['ErrorSignUp'] = "";

    // Проверка пользователей с таким же логином
    foreach ($loginsUser as $logUser) {
        if ($login == $logUser[0]) {
            $_SESSION['ErrorSignUp'] = "Пользователь с таким логином уже зарегестрировался";
            $_SESSION['SuccessSignUp'] = "";
            header('Location: ../');
            exit();
        } else {
            $_SESSION['ErrorSignUp'] = "";
            $_SESSION['SuccessSignUp'] = "";
        }
    }
    // Проверка пользователей с такой же почтой
    foreach ($emailsUser as $emaUser) {
        if ($email == $emaUser[0]) {
            $_SESSION['ErrorSignUp'] = "Пользователь с такой почтой уже зарегестрировался";
            $_SESSION['SuccessSignUp'] = "";
            header('Location: ../');
            exit();
        } else {
            $_SESSION['ErrorSignUp'] = "";
            $_SESSION['SuccessSignUp'] = "";
        }
    }
    // проверка пароля
    if ($password1 != $password2) {
        $_SESSION['ErrorSignUp'] = "Пароли не совпадают";
        $_SESSION['SuccessSignUp'] = "";
        header('Location: ../');
        exit();
    } else {
        $password = password_hash($password1, PASSWORD_DEFAULT);
        $mysql->query("INSERT INTO `users` (`name`, `surname`, `numberClass`, `letterClass`, `email`, `login`, `password`) VALUES('$name', '$surname', '$numberClass', '$letterClass', '$email', '$login', '$password')");
        $_SESSION['SuccessSignUp'] = "Вы успешно зарегистрировались";
        setcookie('login', $login, time()+60*60*24*365*10, "/");
        header("Location: ../");
        exit();
    }

?>