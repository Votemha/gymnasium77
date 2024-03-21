<?php
    session_start();
    $code = rand(100000, 999999);
    $email = $_SESSION['email'];
    $message = "";

    $to = $email;
    $subject = "Проверка почты в gymnasium77";
    $message .= '<!DOCTYPE HTML> <html><head><title>заказ</title></head><body>';
    $message .= "<h2>Вы зарегестрировались на ресурсе gymnasium77</h2><br/>";
    $message .= "<h1>Ваш код: <span style='border:1px solid black;padding:5px'>" .$code . "</span></h1>";
    $message .= "<h3>Если это были не вы - просто проигнорируйте данное сообщение или обратитесь в поддержку</h3>";
    $message .= "</body></html>";

    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset="UTF-8"' . "\r\n";
    mail($to, $subject, $message, $headers);
    $_SESSION['codeEmail'] = password_hash($code, PASSWORD_DEFAULT);
    header("Location: ../email")
?>