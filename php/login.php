<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

//================= Validate Data ============================
// define variables and set to empty values

//Set variables
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["userID"])) {
        $error = "UserID is required";
    } else if (empty($_POST["password"])) {
        $error = "Password is required";
    }
    //Check calling origin
    $userID = $_POST["userID"];
    $password = $_POST["password"];
    $accountType = $_POST["accountType"];

    $sql = "SELECT PASSWORD, ROLE from students WHERE ID='$userID'";
    $results = mysqli_query($con,$sql) or die("Invalid query: " . mysqli_error());
    if ( mysqli_num_rows($results) > 0 ){
        while( $row = mysqli_fetch_assoc($results)){
            if ($row["ROLE"] != "$accountType") {
                $error = "You selected wrong account type";
            } else {
                if($row["PASSWORD"] == "$password") {
                    $_SESSION['login_user'] = $userID;
                    $_SESSION['usertype'] = $accountType;
                    if ($row["ROLE"]== "STUDENT") {
                        header("location: ../html/quizlistpage.html"); // Redirecting To Other Page
                    } else {
                        header("location: ../html/teacherMain.html"); // Redirecting To Other Page
                    }
                } else {
                    $error = "Incorrect credentials.";
                }
            }
        }
    }
}


//Close connection to server
mysqli_close($con);

?>