<!-- Дата на русском -->
<?php
    session_start();
    if (date('l') == 'Monday') {
        $dateRu = 'ПН - ';
    } elseif (date('l') == 'Tuesday') {
        $dateRu = 'ВТ - ';
    } elseif (date('l') == 'Wednesday') {
        $dateRu = 'СР - ';
    } elseif (date('l') == 'Thursday') {
        $dateRu = 'ЧТ - ';
    } elseif (date('l') == 'Friday') {
        $dateRu = 'ПТ - ';
    } elseif (date('l') == 'Saturday') {
        $dateRu = 'СБ - ';
    } elseif (date('l') == 'Sunday') {
        $dateRu = 'ВС - ';
    }
    
    if (intdiv(date('n'), 10) != 0){
        $dateRu = $dateRu . date('j.n.y');
    } else{
        $dateRu = $dateRu . date('j.0n.y');
    }

?>


<!-- Навигационная панель для телефонов -->
        <?php
            $res = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
            $row = $res->fetch_assoc();
        ?>
        <div class="mobileNav">
            <div class="contentMob">
                <div class="newsMob <?=$newsMobAdapt?>" onclick="location.href='<?=$newsClick?>';"><img src="../img/news.png" alt="Новости"></div>
                <div class="deciderMob"></div>
                <div class="scheduleMob <?=$scheduleMobAdapt?>" onclick="location.href='<?=$scheduleClick?>';"><img src="../img/schedule.png" alt="Расписание"></div>
                <div class="deciderMob"></div>
                <div class="recMob <?=$recMobAdapt?>" onclick="location.href='<?=$recClick?>';"><img src="../img/rec.png" alt="Рекомендации"></div>
                <div class="deciderMob"></div>
                <div class="myClassMob <?=$myClassMobAdapt?>" onclick="location.href='<?=$classClick?>';"><span><?=$_SESSION['classBar']?></span></div>
                <div class="deciderMob"></div>
                <div class="profileMob <?=$profileMobAdapt?>" onclick="location.href='<?=$profileClick?>';"><img src="../img/profile.png" alt="Профиль"></div>
            </div>
        </div>



<!-- <script>
        var results = document.cookie.match(/scroll=(.+?)(;|$)/)
        var scrolling = results['input'].split('; ')[3].substr(7);
        console.log(scrolling)
        window.scrollTo(0, scrolling)
    </script> -->
<!-- освнова для всех страниц (с nav, news, schedule) -->
<div class="main">
    <!-- левый блок -->
        <div class="Left">
            <div class="close">x</div>
            <!-- нав бар -->
            <div class="nav">
                <div class="navContent">
                    <div class="<?=$profile?>" onclick="location.href='<?=$profileClick?>';">Профиль</div>
                    <div class="<?=$rec?>" onclick="location.href='<?=$recClick?>';">Рекомендации</div>
                    <div class="<?=$class?>" onclick="location.href='<?=$classClick?>';">Мой класс</div>
                    <div class="<?=$schedule?>" onclick="location.href='<?=$scheduleClick?>';">Расписание</div>
                    <div class="<?=$news?>" onclick="location.href='<?=$newsClick?>';">Новости</div>
                </div>
            </div>
            <!-- расписание -->
            <div class="schedule">
                <div class="scheContent">
                    <p><?=$dateRu?></p>
                    <div class="study">
                        <div>8:00 - Алгебра</div>
                        <div>9:00 - Геометрия</div>
                        <div>10:00 - Геграфия</div>
                        <div>11:00 - История</div>
                        <div>12:00 - Рус. яз.</div>
                        <div>13:00 - Лит-ра</div>
                        <div>14:00 - Физ-ра</div>
                    </div>
                </div>
            </div>
            <div class="newsAdapt1">

            </div>
        </div>
        

        <!-- основной контент страницы -->
        <div class="content">
        <img class="burger" src="../img/icon-menu.png" alt="">

        <script>
            const burger = document.querySelector('.burger')
            const close = document.querySelector('.close')
            const Left = document.querySelector('.Left')
            burger.addEventListener("click", function(e) {
                Left.classList.add('adaptLeft')
            })
            close.addEventListener("click", function(e) {
                Left.classList.remove('adaptLeft')
            })
        </script>