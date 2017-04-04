<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    unset($_SESSION['masterID']);
    session_destroy();
    header("location:index.html");
?>