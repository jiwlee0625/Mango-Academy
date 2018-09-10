//Define Gloabl Variables
var totalNumOfQuestions;
var correctAnswer;
var guessCount=0;
var questionCount = 0;


function setUpPage(){
    var subject = getCookie("subject")
    //subject = subject.charAt(0).toUpperCase() + subject.substr(1);
    document.getElementById('subject').innerText = subject ;
    document.getElementById('answerText').focus();
    retrieveQuestionsFromDataTable();
}

function retrieveQuestionsFromDataTable(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            totalNumOfQuestions=questions.length;
            generateQuestion();
            generateAnswerOptions();
        }
    }
    xhttp.open("POST", "retrieveQuestionsFromDataTable.php" , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}


function generateQuestion(){
    var questionBox = document.getElementById("questionBox");
    var presentNumOfQuestions = questions.length;
    //var thisQuestionNum = Math.floor( Math.random() * presentNumOfQuestions );
    var thisQuestionNum = questionCount;
    questionBox.innerText = questions[thisQuestionNum].question ;
    correctAnswer = questions[thisQuestionNum].answer;
    // q.splice(thisQuestionNum,1);
    questionCount++;
}

function generateAnswerOptions(){
    var answerText = document.getElementById("answerText");

    for( var i=0; i<totalNumOfQuestions; i++){
        var opt = document.createElement("option");
        opt.value = questions[i].answer;
        opt.innerText = questions[i].answer;
        answerText.appendChild(opt);
        // try { console.log(questions[i].answer); } catch(err) { console.log(err); }
        // console.log(i);
    }
}


function checkAnswer(){
    var answerMsg = document.getElementById("answerMsg").firstChild;
    var answerText = document.getElementById("answerText");
    var pageMsgBox = document.getElementById("pageMsgBox");
    var pageMsg = document.getElementById("quizContainer");
    var message = document.getElementById("mqpMessage");
    var qRem = totalNumOfQuestions - questionCount - 1;
    var thisEmoji = questionCount % correctEmojis.length;

    if( answerText.options[answerText.selectedIndex].value.toLowerCase() == correctAnswer.toLowerCase() ){
        if( questionCount < totalNumOfQuestions ){
            setTimeout(
                function(){
                    //message.style.height="10vh";
                    answerMsg.innerHTML = qRem + " more question" + ((qRem==1) ? "" : "s") + " to go.";
                    answerText.value = "";
                    generateQuestion();
                }, 2000);
        } else {
            pageMsg.style.fontSize = "4vh";
            pageMsg.style.margin="30vh";
            pageMsg.style.backgroundColor="white";
            pageMsg.style.textAlign = "center";
            pageMsg.innerHTML = "You Have Completed This Quiz!! <br> Click the back button to choose another quiz to solve or log out to quit.";
            //pageMsgBox.style.backgroundImage = "url( ../img/party.png)";
            pageMsgBox.style.backgroundColor = "white";
            pageMsgBox.style.visibility = "visible";
        }

    } else {
            answerMsg.innerHTML = "The correct Answer is";
            answerText.value = correctAnswer;
            answerButton.value = "";

            setTimeout(
                function(){
                if (qRem >= 0) {
                    answerMsg.innerHTML = qRem + " more question" + ((qRem==1) ? "" : "s") + " to go after this question.";
                    answerText.value = "";
                    generateQuestion();
                    answerButton.value = "Enter";
                }
                if (qRem < 0) {
                    pageMsg.style.fontSize = "4vh";
                    pageMsg.style.margin="30vh";
                    pageMsg.style.backgroundColor="white";
                    pageMsg.style.textAlign = "center";
                    pageMsg.innerHTML = "You Have Completed This Quiz!! <br> Click the back button to choose another quiz to solve or log out to quit.";
                    //pageMsgBox.style.backgroundImage = "url( ../img/party.png)";
                    pageMsgBox.style.backgroundColor = "white";
                    pageMsgBox.style.visibility = "visible";
                }
            },4000);
    }
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

