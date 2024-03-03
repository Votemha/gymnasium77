<?php
    setcookie('login', "", time()-60*60*24*365*10, "/");
    header("Location: ../");
?>