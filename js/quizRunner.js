var correctAnswer;
var questionsRight=0;
var questionCount = 0;
var totalNumOfQuestions = questions.length;


function setUpPage(){
    var subject = getCookie("subject")
    subject = subject.charAt(0).toUpperCase() + subject.substr(1);
    document.getElementById('subject').innerText = subject ;
    retrieveQuestionsFromDataTable();
}

function retrieveQuestionsFromDataTable(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            totalNumOfQuestions=questions.length;
            generateQuestions();
        }
    }
    xhttp.open("POST", "../php/quizLoader.php" , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

}
function generateQuestion(){
    var questionBox = document.getElementById("questionBox");
    var presentNumOfQuestions = questions.length;
    var thisQuestionNum = Math.floor( Math.random() * presentNumOfQuestions );

    questionBox.innerText = questions[thisQuestionNum].question ;
    correctAnswer = questions[thisQuestionNum].answer;
    questions.splice(thisQuestionNum,1);
    questionCount++;
}

function generateAnswerOptions(){
    var answerText = document.getElementById("answerText");
    for( var i = 0; i < questions.length; i++){
        var opt = document.createElement("option");
        opt.value = questions[i].answer;
        opt.innerText =questions[i].answer;
        answerText.appendChild(opt);
    }
}

function restart() {
    window.location.reload();
}

function checkAnswer(){
    var answerMsg = document.getElementById("answerMsg").firstChild;
    var answerText = document.getElementById("answerText");
    var pageMsgBox = document.getElementById("pageMsgBox");
    var pageMsg = document.getElementById("pageMsg");
    var header = document.getElementById("header");
    var qRem = totalNumOfQuestions - questionCount - 1;
    var thisEmoji = 0;

    if( answerText.options[answerText.selectedIndex].value.toLowerCase() == correctAnswer.toLowerCase() ){
        questionsRight++;
        if( questionCount < totalNumOfQuestions ){
            answerMsg.innerHTML = qRem + " more question" + ((qRem==1) ? "" : "s") + " to go after this question.";
            answerText.value = "";
            generateQuestion();
        } else {
            header.style.height = "100vh";
            pageMsg.style.fontSize = "4vh";
            pageMsg.innerHTML = "You have completed this quiz!! <br> You got " + Math.round(((questionsRight / questionCount) * 100)) + "% correct!";
            pageMsgBox.style.background.color = "white";
            pageMsgBox.style.visibility = "visible";
        }

    } else {
        answerMsg.innerHTML = "The correct answer is";
        answerText.value = correctAnswer;
        answerButton.value = "";
        setTimeout(
            function(){
                if (qRem >= 1) {
                    header.style.height="14vh";
                    answerMsg.innerHTML = qRem + " more question" + ((qRem==1) ? "" : "s") + " to go after this question.";
                    answerText.value = "";
                    generateQuestion();
                    answerButton.value = "Enter";
                }
                if (qRem <= 0) {
                    header.style.height = "100vh";
                    pageMsg.style.fontSize = "4vh";
                    pageMsg.innerHTML = "You have completed this quiz!! <br> You got " + Math.round(((questionsRight / questionCount) * 100)) + "% correct!";
                    pageMsgBox.style.background.color = "white";
                    pageMsgBox.style.visibility = "visible";
                }
            },4000);
    }
}

