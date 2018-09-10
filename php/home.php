<?php
include('login.php'); // Includes Login Script
/*
if(isset($_SESSION['login_user'])){
    if ($_SESSION['userType']== "STUDENT") {
        header("location: quizlistpage.php"); // Redirecting To Other Page
    } else if ($_SESSION['userType']== "TEACHER") {
        header("location: teacherMain.php"); // Redirecting To Other Page
    }
}*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Mango Academy</title>
    </head>

    <body>
        <!-- Top Layer -->
        <div class="emptyBttn" id="empty">
            <!--space holder: will be place for another button"-->
        </div>
        <div class="navButton" id="registerBttn" onclick="logout()">
            <!-- Not Implemented -->
            <p>Register</p>
        </div>
        <div id="logo">
            <h1>Mango Academy</h1>
        </div>
        <div id = "loginSpace">
            <form action="" method="post">
                User ID: <input type="text" name="userID"><br><br>
                Password: <input type="text" name="password"><br><br>
                Log in as:<br>
                <input type="radio" name="accountType" value="STUDENT" checked> Student<br>
                <input type="radio" name="accountType" value="TEACHER"> Teacher<br><br>
                <input type="submit" id="submitBttn" value="Start!">
            </form>
        </div>
    </body>>
</html>