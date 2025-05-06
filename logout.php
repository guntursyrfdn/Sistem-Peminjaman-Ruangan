<?php 
    session_start();
    session_unset();
    session_destroy();
    $msg = "<p class='alert alert-warning'>Anda Telah Loguot</p>";
    header("Location: login.php?msg=$msg");
?>