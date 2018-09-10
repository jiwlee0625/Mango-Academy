<?php
    session_start();
    if(isset($_SESSION['login_user'])) {
        unset($_SESSION['login_user']);  //Is Used To Destroy Specified Session
        if(isset($_SESSION['userType'])) {
            unset($_SESSION['login_user']);  //Is Used To Destroy Specified Session
        }
        header("location: home.php");
    }
?>