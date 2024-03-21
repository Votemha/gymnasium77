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
    ?>
    <!-- основной контент -->
    <div class="mainContent">
        <div class="email">
            <p>Проверка почты</p>
            <div class="content">
                <!-- вернуть назад -->
                <span class="arrow"><img src="../img/arrow.png" alt="Вернуться"></span>
                <p class="textCode">Введите код с почты</p>
                <form action="email.php" method="POST">
                    <div class="inpCode">
                        <!-- почта пользователя -->
                        <p class="mail" title="Почта" name="email" value="<?=$_SESSION['email']?>"><span><?=$_SESSION['email']?></span></p>
                        <!-- сам код -->
                        <input type="text" name="codeUser" maxlength="6" placeholder="123456" onkeypress="return event.charCode >= 48 && event.charCode <= 57"><br/>
                        <input class="done" type="submit" value="Готово">
                        <input type="hidden" name="login" value="<?=$_SESSION['login']?>">
                    </div>
                    <span><?=$_SESSION['ErrorSignUp']?></span>
                </form>
                <span class="addText">*Мы отправили 6ти значный код на Вашу почту для её подтверждения введите его в поле выше</span>
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