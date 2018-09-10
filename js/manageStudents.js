function addStudent(){
    document.getElementById("submitType").value = "addStudent";
    document.getElementById("qaForm").submit();
}

function viewStudents(){
    document.getElementById("submitType").value = "viewStudents";
    document.getElementById("qaForm").submit();
}

function delQuestion(){
    document.getElementById("submitType").value = "delQuestion";
    document.getElementById("qaForm").submit();
}

function selectData(e){
    e.parentNode.innerHTML = "<input type='text' style='size:10' name='editData' value='" + e.innerText + "'>"
    + "<input type='button' value='Ok' onclick='editQuestion(" +  '"'+ e.id + '"' + ")';>";
}

function editQuestion(id){
    document.getElementById("submitType").value = id + "_editQuestion";
    document.getElementById("qaForm").submit();
}
