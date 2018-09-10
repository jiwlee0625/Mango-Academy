<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <script type="text/javascript" src="../js/manageQs.js"></script>
        <title>Mango Academy</title>
    </head>

    <body>

       <!-- Top Layer -->
        <div class="navButton" id="backBttn" onclick="goBack()">
            <!--space holder: will be place for another button"-->
            <p>BACK</p>
        </div>
        <div class="navButton" id="registerBttn" onclick="logout()">
            <p>Log Out</p>
        </div>
        <div id="logo">
            <h1>Mango Academy</h1>
        </div>
        <div id = "formspace">
            <form id="qaForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <div id="selection">
            <p>Select Subject:
                <input type="radio" name="selectedSubject" value="All" checked> ALL &nbsp; &nbsp;
                <input type="radio" name="selectedSubject" value="ENGLISH"> ENGLISH &nbsp; &nbsp;
                <input type="radio" name="selectedSubject" value="MATH"> MATH &nbsp; &nbsp;
                <input type="radio" name="selectedSubject" value="HISTORY"> HISTORY &nbsp; &nbsp;
                <input type="radio" name="selectedSubject" value="SCIENCE"> SCIENCE &nbsp; &nbsp;
                <input type="button" value="View Questions" onclick="viewQuestion();">
                <input type="hidden" name="submitType" id="submitType" value="">
            </p>
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                //Add Question
                if ($_POST["submitType"] == "addQuestion"){
                    //Set up the query
                    $grade = $_POST['grade'];
                    $subject = $_POST['subject'];
                    $question = $_POST['question'];
                    $answer = $_POST['answer'];
                    $sql = "INSERT INTO questions (GRADE, SUBJECT, QUESTION, ANSWER)
                    VALUES ('". $grade . "', '" . $subject . "', '" . $question . "', '" . $answer . "')";

                    //Execute query and test
                    if (!mysqli_query($con, $sql)) {
                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                    }
                }

                //Update
                if (strpos($_POST["submitType"], "editQuestion") !== false ){
                    $fieldQIDdata = explode("_",$_POST["submitType"]);
                    echo $fieldQIDdata[0];
                    echo $fieldQIDdata[1];
                    echo $fieldQIDdata[2];
                    $sql = "UPDATE questions SET " . $fieldQIDdata[0] . "='" . $_POST["updateData"] . "' WHERE QID='" . $fieldQIDdata[1] ."'";
                    //Execute and test
                    if (!mysqli_query($con, $sql)) {
                        echo "Error updating record: " . mysqli_error($con);
                    }
                }

                //Delete checked records
                if ((count($_POST["QID"]) > 0) && ($_POST["submitType"]=="delQuestion")) {
                    foreach($_POST["QID"] as $id){
                        $sql = "DELETE FROM questions WHERE QID='" . $id . "'";
                        if (!mysqli_query($con, $sql)) {
                            echo "Error deleting record: " . mysqli_error($con);
                        }
                    }
                }

                if (($_POST["submitType"] == "addQuestion") ||($_POST["submitType"] == "viewQuestion") || ($_POST["submitType"]=="delQuestion") || (strpos($_POST["submitType"], "editQuestion") !== false)){
                    //Set up query parts to search for user's selection

                    if ($_POST["selectedSubject"] == 'All'){
                        $subjectSearch = "";
                    } else {
                        $subjectSearch = "(SUBJECT = '" . $_POST["selectedSubject"] . "') ";
                    }

                    // //Assemble query string from query parts
                    if ($subjectSearch=="") {
                         $sql = "SELECT * FROM questions";
                     } else {
                         $sql = "SELECT * FROM questions  WHERE " . $subjectSearch ;
                    }

                    //Run selection Query
                    $result = mysqli_query($con, $sql);
                    ?>

                    <script>
                         document.getElementById('placeholder').style.display = 'none';
                    </script>

                    <?php

                    //Make output data table of selections
                    echo '<div id="allQs">';
                    //Table Headers
                    echo ' <table id="dataTable"> ';
                    echo ' <tr> ';
                    echo ' <th><input id="delButton" type="button" name="delButton" value="delete" onclick="delQuestion();"></th>';
                    echo ' <th>SUBJECT</th><th>QUESTION</th><th>ANSWER</th> ';
                    echo ' </tr> ';

                    //Fill in table data from query results
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . '<input type="checkbox" name="QID[' . $row["QID"] . ']" value="' . $row["QID"] .'">';
                            // echo '<td>' . $row["QID"] . '</td>';
                            // echo '<td>' . $row["GRADE"] . '</td>';
                            echo '<td>' . $row["SUBJECT"] . '</td>';
                            echo '<td><span id="QUESTION_' . $row["QID"] . '" onclick="selectData(this);">' . $row["QUESTION"] . '</span></td>';
                            echo '<td><span id="ANSWER_'. $row["QID"] . '" onclick="selectData(this);">' . $row["ANSWER"] . '</span></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }

                    //End table
                    echo ' </table> ';
                    echo '</div>';
                }

                //Close server connection
                mysqli_close($con);
            }
            ?>

            <div id="newQ">
                <p>Add a new question: </p>
                Subject:
                    <select name="subject">
                        <option value="ENGLISH">English</option>
                        <option value="MATH">Math</option>
                        <option value="HISTORY">History</option>
                        <option value="SCIENCE">Science</option>
                    </select> &nbsp; &nbsp;
                Question: <input type="text" name="question" size="40"> &nbsp;
                Answer: <input type="text" name="answer" size="40"><br><br>
                <input type="button" value="Add Question" onclick="addQuestion();">
            </div>


        </form>
        </div>

    </body>
</html>

<script>
    function goBack(subject){
        window.location.assign("../html/teacherMain.html");
    }
    function logout() {
        window.location.href = 'logout.php';
    }
</script>
