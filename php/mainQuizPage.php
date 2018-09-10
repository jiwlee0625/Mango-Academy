<!DOCTYPE html>
<html>
    <head>
        <title>Mango Academy</title>
        <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
        <script type="text/javascript" src="../js/scriptsMainQuizPage.js"></script>
        <script type="text/javascript" src="../js/emojis.js"></script>
        <script type="text/javascript" src="../js/tempQuestions.js"></script>
  </head>
    <body onload="setUpPage();">

        <!-- Top Layer -->
        <div class="navButton" id="backBttn" onclick="goBack()">
            <p>BACK</p>
        </div>
        <div class="navButton" id="logoutBttn" onclick="logout()">
            <!-- Not Implemented -->
            <p>Log Out</p>
        </div>
        <div id="logo">
            <h1>Mango Academy</h1>
        </div>

        <div id="quizContainer">
            <div id="mqpTitle" class="mqpTile mqprow1 mqpcol1">
                <p class="titleText"><span id="subject"></span> Quiz</p>
            </div>
            <div id="mqpMessage" class="mqpTile mqprow2 mqpcol1">
                <div id="pageMsgBox">
                    <p id="pageMsg"></p>
                </div>
            </div>
            <div id="questionBox"></div>
            <div id="answerWord"></div>
            <div id="answerMsg"><p>Click the box below, Select your answer, Then press enter</p></div>
            <div id="answerBox">
                <select id="answerText"> <option value="" selected></option> </select>
            </div>
            <div id="enterBox">
                <input type="button" value="Enter" id="answerButton" onclick="checkAnswer();">
            </div>
        </div>

    </body>
</html>
<script>
    function goBack(){
        window.location.assign("../html/quizlistpage.html");
    }
    function logout() {
        window.location.href = 'logout.php';
    }
</script>