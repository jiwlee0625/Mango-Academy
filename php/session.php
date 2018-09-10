<?php
    $servername = "localhost";
    $username = "cedrictstallwort";
    $password = "";
    $dbname = "LEEjiwon";

    // Create connection
    $con=mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (mysqli_connect_errno()) {
      	echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    session_start();// Starting Session
    // Storing Session
    $user_check=$_SESSION['login_user'];

    // SQL Query To Fetch Complete Information Of User
    $ses_sql=mysql_query("SELECT ID, ROLE from students WHERE ID='$userID'", $con);
    $row = mysql_fetch_assoc($ses_sql);
    $login_session =$row['ID'];
    if(!isset($login_session)){
        mysql_close($connection); // Closing Connection
        header('Location: home.php'); // Redirecting To Home Page
    }
?>