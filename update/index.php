<?php
    session_start();
    $update = $_SESSION['update'];
    header("Location: $update");
?>