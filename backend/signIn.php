<?php
    session_start();
    include '../db.php';

    $login = $_POST['login'];
    $loginsUser = mysqli_fetch_All(mysqli_query($mysql, "SELECT `login` FROM `users`"));
    $passwordUser = $_POST['password'];
    $passwordHash = $mysql->query("SELECT `password` FROM `users` WHERE `login` = '$login'")->fetch_assoc();
    $a = 1;

    // проверка логина в списке
    foreach ($loginsUser as $logUser) {
        if ($login == $logUser[0]) {
            $a *= 0;
        } else {
            $a *= 1;
        }
    }
    // сравнение логина
    if ($a == 0) {
        // создание ошибок
        $_SESSION['ErrorSignUp'] = "";
        $_SESSION['SuccessSignUp'] = "";
    } else {
        // создание ошибок
        $_SESSION['ErrorSignUp'] = "Неправильный логин";
        $_SESSION['SuccessSignUp'] = "";
        header('Location: ../');
        exit();
    }
    // сравнение паролей
    if (password_verify($passwordUser, $passwordHash['password'])) {
        // создание ошибок
        $_SESSION['SuccessSignUp'] = "Успешно";
        // создание куки
        setcookie('login', $login, time()+60*60*24*365*10, "/");
        header("Location: ../");
        exit();
    }
    header("Location: ../");
?>