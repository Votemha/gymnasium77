<?php
    // подключаем базу данных
    include '../db.php';

    // создаём переменые
    $id = $_POST['id'];
    $del = $_POST['del'];
    $like1 = $_POST['like'];
    $like2 = $_POST['likePressed'];
    $dislike1 = $_POST['dislike'];
    $dislike2 = $_POST['dislikePressed'];
    $login = $_POST['login'];
    $quality = $mysql->query("SELECT `likes` FROM `posts` WHERE `login` = '$login' AND `id` = '$id'");
    $emailUser = $_POST['emailUser'];
    $allUserLike = explode(";", $mysql->query("SELECT `usersLike` FROM `posts` WHERE `login` = '$login' AND `id` = '$id'")->fetch_assoc()['usersLike']);
    $allUserDislike = explode(";", $mysql->query("SELECT `usersDislike` FROM `posts` WHERE `login` = '$login' AND `id` = '$id'")->fetch_assoc()['usersDislike']);
    $page = $_POST['page'];

    // счётчик есть ли человек в списке
    // тех кто лайкнул
    $a = 1;
    // тех кто дизлайкнул
    $e = 1;

    // при нажатии на плюс
    if (isset($like1) || isset($like2)) {
        // перебераем список всех пользователей, которые поставли лайк
        foreach($allUserLike as $login1) {
            // сравниваем пользователя со списком
            // если такого нет, то умножаем счётчик на 1
            if ($login1 != $emailUser) {
                $a *= 1;
            // в обратном же случае умножаем на 0
            } else {
                $a *= 0;
            }
        }
        // если человека нет в списке пользователей, которые поставили лайк (счётчик $a равен 1), то
        if ($a == 1) {
            // получаем список всех пользователей и добавляем нового пользователя 
            $users = $mysql->query("SELECT `usersLike` FROM `posts` WHERE `login` = '$login' AND `id` = '$id'")->fetch_assoc()['usersLike'] . $emailUser . ";";
            // прибавляем значение лайка поста
            $mysql->query("UPDATE `posts` SET  `likes` = `likes` + 1 WHERE `login` = '$login' AND `id` = '$id'");
            // обновляем значение пользователей, которые оценили пост
            $mysql->query("UPDATE `posts` SET  `usersLike` = '$users' WHERE `login` = '$login' AND `id` = '$id'");
            // вводим переменные
            // новый список пользователей, которые поставили дизлайк (без данного пользователя)
            $newAllUserDislike = '';
            // счётчик для выполнения цикла
            $i = 0;
            // цикл: пока счётчик меньше длины массива
            while ($i <= count($allUserDislike)) {
                // если пользователь в списке - не данный пользователь и не равен NULL
                // то добавить в новый список этого человека и ';'
                if ($allUserDislike[$i] != $emailUser and $allUserDislike[$i] != NULL) {
                    $newAllUserDislike = $newAllUserDislike . $allUserDislike[$i] . ';';
                // или же если данный человек есть в списке, то вернуть счётчик лайков
                } else if ($allUserDislike[$i] == $emailUser) {
                    $mysql->query("UPDATE `posts` SET  `likes` = `likes` + 1 WHERE `login` = '$login' AND `id` = '$id'");
                }
                // увеличить счётчик на 1
                $i += 1;
            }
            // добавляем новый список пользователей, поставивших дизлайк в базу данных
            $mysql->query("UPDATE `posts` SET  `usersDislike` = '$newAllUserDislike' WHERE `login` = '$login' AND `id` = '$id'");
        // если же человек есть в списке пользователей, которые поставили лайк, то
        } else {
            // возвращаем счётчик на место без данного
            $mysql->query("UPDATE `posts` SET  `likes` = `likes` - 1 WHERE `login` = '$login' AND `id` = '$id'");
            // вводим переменные
            // новый список пользователей, которые поставили лайк (без данного пользователя)
            $newAllUserLike = '';
            // счётчик для выполнения цикла
            $i = 0;
            // цикл: пока счётчик меньше длины массива
            while ($i < count($allUserLike)) {
                // если пользователь в списке - не данный пользователь и не равен NULL
                // то добавить в новый список этого человека и ';'
                if ($allUserLike[$i] != $emailUser && $allUserLike[$i] != NULL) {
                    $newAllUserLike = $newAllUserLike . $allUserLike[$i] . ';';
                }
                // увеличить счётчик на 1
                $i += 1;
            }
            // добавляем новый список пользователей, поставивших дизлайк в базу данных
            $mysql->query("UPDATE `posts` SET  `usersLike` = '$newAllUserLike' WHERE `login` = '$login' AND `id` = '$id'");
        }
    } 
    


    // при нажатии на минус
    if (isset($dislike1) || isset($dislike2)) {
         // перебераем список всех пользователей, которые поставли дизлайк
        foreach($allUserDislike as $login2) {
            // сравниваем пользователя со списком
            // если такого нет, то умножаем счётчик на 1
            if ($login2 != $emailUser) {
                $e *= 1;
            // в обратном же случае умножаем на 0
            } else {
                $e *= 0;
            }
        }
        // если человека нет в списке пользователей, которые поставили дизлайк (счётчик $a равен 1), то
        if ($e == 1) {
            // получаем список всех пользователей и добавляем нового пользователя 
            $users = $mysql->query("SELECT `usersDislike` FROM `posts` WHERE `login` = '$login' AND `id` = '$id'")->fetch_assoc()['usersDislike'] . $emailUser . ";";
            // прибавляем значение лайка поста
            $mysql->query("UPDATE `posts` SET  `likes` = `likes` - 1 WHERE `login` = '$login' AND `id` = '$id'");
            // обновляем значение пользователей, которые оценили пост
            $mysql->query("UPDATE `posts` SET  `usersDislike` = '$users' WHERE `login` = '$login' AND `id` = '$id'");
            // вводим переменные
            // новый список пользователей, которые поставили лайк (без данного пользователя)
            $newAllUserLike = '';
            // счётчик для выполнения цикла
            $i = 0;
            // цикл: пока счётчик меньше длины массива
            while ($i < count($allUserLike)) {
                // если пользователь в списке - не данный пользователь и не равен NULL
                // то добавить в новый список этого человека и ';'
                if ($allUserLike[$i] != $emailUser && $allUserLike[$i] != NULL) {
                    $newAllUserLike = $newAllUserLike . $allUserLike[$i] . ';';
                // или же если данный человек есть в списке, то вернуть счётчик лайков
                } else if ($allUserLike[$i] == $emailUser) {
                    $mysql->query("UPDATE `posts` SET  `likes` = `likes` - 1 WHERE `login` = '$login' AND `id` = '$id'");
                }
                $i += 1;
            }
            // добавляем новый список пользователей, поставивших лайк в базу данных
            $mysql->query("UPDATE `posts` SET  `usersLike` = '$newAllUserLike' WHERE `login` = '$login' AND `id` = '$id'");
        // если же человек есть в списке пользователей, которые поставили дизлайк, то
        } else {
            // возвращаем счётчик на место без данного
            $mysql->query("UPDATE `posts` SET  `likes` = `likes` + 1 WHERE `login` = '$login' AND `id` = '$id'");
            // вводим переменные
            // новый список пользователей, которые поставили дизлайк (без данного пользователя)
            $newAllUserDislike = '';
            // счётчик для выполнения цикла
            $i = 0;
            // цикл: пока счётчик меньше длины массива
            while ($i <= count($allUserDislike)) {
                // если пользователь в списке - не данный пользователь и не равен NULL
                // то добавить в новый список этого человека и ';'
                if ($allUserDislike[$i] != $emailUser and $allUserDislike[$i] != NULL) {
                    $newAllUserDislike = $newAllUserDislike . $allUserDislike[$i] . ';';
                }
                // увеличить счётчик на 1
                $i += 1;
            }
            // добавляем новый список пользователей, поставивших дизлайк в базу данных
            $mysql->query("UPDATE `posts` SET  `usersDislike` = '$newAllUserDislike' WHERE `login` = '$login' AND `id` = '$id'");
        }
    }

    if (isset($del)) {
        $mysql->query("DELETE FROM `posts` WHERE `login` = '$login' AND `id` = '$id'");
    }

    // вернуться на страницу
    header("Location: $page");
?>