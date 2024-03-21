<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Проверка почты</title>
</head>
<body>
    <!-- Основной бекэнд -->
    <?php
        session_start();
        include '../db.php';
        $_SESSION['pageSign'] = "forgotPass";
    ?>
    <!-- основной контент -->
    <div class="mainContent">
        <div class="email">
            <p>Проверка почты</p>
            <div class="content">
                <!-- вернуть назад -->
                <span class="arrow"><img src="../img/arrow.png" alt="Вернуться"></span>
                <p class="textCode">Введите почту</p>
                <form action="" method="POST">
                    <div class="inpCode">
                        <!-- сам код -->
                        <input type="text" name="emailFP" placeholder="Почта"><br/>
                        <input class="done" type="submit" value="Готово">
                        <input type="hidden" name="login" value="<?=$_SESSION['login']?>">
                    </div>
                    <span><?=$_SESSION['ErrorSignUp']?></span>
                </form>
                <span class="addText">*Мы отправим шестизначный код на Вашу почту для её подтверждения введите его в поле выше</span>
            </div>
        </div>
    </div>
    <script>
        const arrow = document.querySelector(".arrow")
        arrow.addEventListener("click", function(e) {
            window.location = "../"
        })
    </script>
    <?php
        $a = 1;
        $emails = $mysql->query("SELECT `email` FROM `users`");
        foreach ($emails as $em) {
            if ($_POST['emailFP'] == $em['email']) {
                $a *= 0;
            } else {
                $a *= 1;
            }
        }
        if ($a == 0) {
            if(isset($_POST['emailFP'])) {
                $_SESSION['email'] = $_POST['emailFP'];
                $_SESSION['ErrorSignUp'] = "";
                header("Location: ../backend/emailCode.php");
            }
        } else {
            $_SESSION['ErrorSignUp'] = "Пользователя с такой почтой не существует";
        }
        
    ?>
</body>
</html>