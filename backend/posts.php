<!-- бекенд новые посты -->
<?php
    include '../db.php';
    $datePost = $_POST["datePop"];
    $messagePost = "<pre>" . $_POST["message"] . "</pre>";
    $login = $_POST['login'];
    if ($messagePost != "") {
        $mysql->query("INSERT INTO `posts` (`date`, `message`, `login`) VALUES('$datePost', '$messagePost', '$login')");
    }
        
    header("Location: ../")
?>