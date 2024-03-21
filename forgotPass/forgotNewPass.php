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
        $_SESSION['pageSign'] = "email";
    ?>
    <!-- основной контент -->
    <div class="mainContent">
        <div class="email">
            <p>Проверка почты</p>
            <div class="content">
                <!-- вернуть назад -->
                <span class="arrow"><img src="../img/arrow.png" alt="Вернуться"></span>
                <p class="textCode">Новый пароль</p>
                <form action="../backend/newPass.php" method="POST">
                    <div class="inpCode">
                        <!-- почта пользователя -->
                        <p class="mail" title="Почта" name="email" value="<?=$_SESSION['email']?>"><span><?=$_SESSION['email']?></span></p>
                        <!-- сам код -->
                        <input type="password" name="newPass1" placeholder="Новый пароль"><br/>
                        <input type="password" name="newPass2" placeholder="Повторите пароль"><br/>
                        <input class="done" type="submit" value="Готово">
                    </div>
                    <span><?=$_SESSION['ErrorSignUpNew']?></span>
                </form>
            </div>
        </div>
    </div>
    <script>
        const arrow = document.querySelector(".arrow")
        arrow.addEventListener("click", function(e) {
            window.location = "../"
        })
    </script>
</body>
</html>