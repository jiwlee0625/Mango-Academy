<?php
//Set variables
$servername = "localhost";
$username = "cedrictstallwort";
$password = "";
$dbname = "LEEjiwon";

// Create connection
$con=mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno())
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }



//Retrieve questions and place in JSON format
$subject = $_COOKIE['subject'];
$questions = "var questions = ["; //Start array
$count = 0;
$sql = "SELECT QUESTION, ANSWER from quizList WHERE SUBJECT='$subject'";
$results = mysqli_query($con,$sql) or die("Invalid query: " . mysqli_error());
$resultsCount = mysqli_num_rows($results);
if ( $resultsCount > 0 ){
    while( $row = mysqli_fetch_assoc($results) ){
        $count++;
        $questions .= '{answer:"';
        $questions .= $row['ANSWER'];
        $questions .= '", question:"';
        $questions .= $row['QUESTION'];
        $questions .= ($count < 5) ? '"},' : '"}'; //Handle the commas b/w object entries. None after last
        if($count == 5){ break; } //Only take first five questions
    }
    $questions .= "];" ; //End array
}

//Close connection to server<
mysqli_close($con);

if(($id = fopen('../js/quizQuestions.js','w'))){
    fwrite($id,$questions);
    fclose($id);
}

?>