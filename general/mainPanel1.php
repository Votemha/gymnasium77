<!-- Дата на русском -->
<?php
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
                    <div class="styled">Тема</div>
                    <script>
                        const styled = document.querySelector(".styled")
                        const root = document.querySelector(":root")
                        var results = document.cookie.match(/theme=(.+?)(;|$)/)
                        function hasCookie(name) {
                            return document.cookie.split(';').some(c => c.trim().startsWith(name + '='));
                        }
                        let i = 0
                        if (hasCookie('theme')) {
                            if (results[1] == 'white'){
                                root.style.setProperty('--bg-color', '#E6ECF2')
                                root.style.setProperty('--prop-color', '#FFFFFF')
                                root.style.setProperty('--accent-color', '#D9D9D9')
                                root.style.setProperty('--text-color', '#000000')
                                root.style.setProperty('--accent2-color', '#B3B3B3')
                            } else {
                                root.style.setProperty('--bg-color', '#212121')
                                root.style.setProperty('--prop-color', '#444444')
                                root.style.setProperty('--accent-color', '#2D2D2D')
                                root.style.setProperty('--text-color', '#FFFFFF')
                                root.style.setProperty('--accent2-color', '#444444')
                            }
                            if (results[1] == 'white') {
                                i = 0
                            } else {
                                i = 1
                            }
                        } 
                        styled.addEventListener("click", function(e) {
                            if (i % 2 == 0) {
                                root.style.setProperty('--bg-color', '#212121')
                                root.style.setProperty('--prop-color', '#444444')
                                root.style.setProperty('--accent-color', '#2D2D2D')
                                root.style.setProperty('--text-color', '#FFFFFF')
                                root.style.setProperty('--accent2-color', '#444444')
                                document.cookie = "theme=black; path=/"; 
                            } else {
                                root.style.setProperty('--bg-color', '#E6ECF2')
                                root.style.setProperty('--prop-color', '#FFFFFF')
                                root.style.setProperty('--accent-color', '#D9D9D9')
                                root.style.setProperty('--text-color', '#000000')
                                root.style.setProperty('--accent2-color', '#B3B3B3')
                                document.cookie = "theme=white; path=/";
                            }
                            ++i
                        })
                    </script>
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

        <!-- Сохранение прокрутки страницы
    <script>
        console.log(window.pageYOffset)
        document.cookie = "scroll="+ window.pageYOffset +"; path=/"
    </script> -->