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

    if (isset($_POST['signIn'])) {
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
            // создаем сессии для регистрации
            $password = password_hash($password1, PASSWORD_DEFAULT);
            $_SESSION['SuccessSignUp'] = "Вы успешно зарегистрировались";
            $_SESSION['email'] = $email;
            $_SESSION['login'] = $login;
            $_SESSION['name'] = $name;
            $_SESSION['surname'] = $surname;
            $_SESSION['numberClass'] = $numberClass;
            $_SESSION['letterClass'] = $letterClass;
            $_SESSION['surname'] = $surname;
            $_SESSION['numberClass'] = $numberClass;
            $_SESSION['password'] = $password;
            // проверка почты
            header("Location: ../backend/emailCode.php");
            exit();
        }
    }

?>