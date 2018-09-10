<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <script type="text/javascript" src="../js/manageStudents.js"></script>
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
            <?php
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
                //Set up query parts to search for user's selection

                    // //Assemble query string from query parts
                    $sql = "SELECT * FROM students WHERE ROLE='STUDENT' ORDER BY LNAME ASC";

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
                    echo ' <th>ID</th><th>LASTNAME</th><th>FIRSTNAME</th><th>GRADE</th> ';
                    echo ' </tr> ';

                    //Fill in table data from query results
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . '<input type="checkbox" name="ID[' . $row["ID"] . ']" value="' . $row["ID"] .'">';
                            echo '<td>' . $row["ID"] . '</td>';
                            echo '<td>' . $row["LNAME"] . '</td>';
                            echo '<td>' . $row["FNAME"] . '</td>';
                            echo '<td>' . $row["GRADE"] . '</td>';
                            //echo '<td><span id="QUESTION_' . $row["QID"] . '" onclick="selectData(this);">' . $row["QUESTION"] . '</span></td>';
                            //echo '<td><span id="ANSWER_'. $row["QID"] . '" onclick="selectData(this);">' . $row["ANSWER"] . '</span></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "No student accounts found.";
                    }

                    //End table
                    echo ' </table> ';
                    echo '</div>';


                    //Add Question
                    if ($_POST["submitType"] == "addStudent"){
                        //Set up the query
                        $fname = addslashes($_POST['fname']);
                        $lname = addslashes($_POST['lname']);
                        $grade = addslashes($_POST['grade']);
                        $passwd = addslashes($_POST['passwd']);
                        $imagename = addslashes($_FILES['image']['name']);
                        $image = base64_encode(file_get_contents($_FILES['image']['tmp_name'])); //mysqli_real_escape_string($con, ;
                        $sql = "INSERT INTO students (PASSWORD, FNAME, LNAME, GRADE, ROLE, IMAGE, IMAGENAME)
                        VALUES ('$passwd', '$fname', '$lname', '$grade', 'STUDENT', '$image', '$imagename')";

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
                        $sql = "UPDATE students SET " . $fieldQIDdata[0] . "='" . $_POST["updateData"] . "' WHERE QID='" . $fieldQIDdata[1] ."'";
                        //Execute and test
                        if (!mysqli_query($con, $sql)) {
                            echo "Error updating record: " . mysqli_error($con);
                        }
                    }
                    //Delete checked records
                    if ((count($_POST["ID"]) > 0) && ($_POST["submitType"]=="delQuestion")) {
                        foreach($_POST["ID"] as $id){
                            $sql = "DELETE FROM students WHERE ID='" . $id . "'";
                            if (!mysqli_query($con, $sql)) {
                                echo "Error deleting record: " . mysqli_error($con);
                            }
                        }
                    }
                //Close server connection
                mysqli_close($con);
            ?>

            <div id="newQ">
                <p>Add a new student: </p>
                    First Name: <input type="text" name="fname"><br>
                    Last Name: <input type="text" name="lname"><br>
                    Password: <input type="text" name="passwd"><br>
                    Image: <input type="file" name="image"><br>
                <input type="button" value="Add Student" onclick="addStudent();">
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
