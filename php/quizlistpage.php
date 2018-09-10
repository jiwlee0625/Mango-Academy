<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <title>Mango Academy</title>
    </head>

    <body>
        <!-- Top Layer -->
        <div class="navButton" id="backToMainBttn">
            <!--space holder: button only shows up if user is a teacher"-->
            <p>BACK</p>
        </div>
        <div class="navButton" id="logoutBttn" onclick="logout()">
            <!-- Not Implemented -->
            <p>Log Out</p>
        </div>
        <div id="logo">
            <h1>Mango Academy</h1>
        </div>
        <div id = "prompt">
            <h3>Which quiz would you like to take?</h3>
        </div>
        <div id="quizTypeSelect">
            <div class="quiz" onclick="callQuizPage('english');">
                <h2>English</h2>
            </div>
            <div class="quiz" onclick="callQuizPage('math');">
                <h2>Math</h2>
            </div>
            <div class="quiz" onclick="callQuizPage('history');">
                <h2>History</h2>
            </div>
            <div class="quiz" onclick="callQuizPage('science');">
                <h2>Science</h2>
            </div>
        </div>

    </body>
</html>

<script>
    function callQuizPage(subject){
        document.cookie = "subject=" + subject + "; ; path=/";
        window.location.assign("../html/quiz.html");
    }
    function logout() {
        window.location.href = 'logout.php';
    }
</script>


