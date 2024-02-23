<!-- бекенд новые посты -->
<?php
    include '../db.php';
    $datePost = $_POST["datePop"];
    $messagePost = $_POST["message"];
    $email = 'admin@mail.ru';
    if ($messagePost != "") {
        $mysql->query("INSERT INTO `posts` (`date`, `message`, `email`) VALUES('$datePost', '$messagePost', '$email')");
    }
        
    header("Location: ../")
?>