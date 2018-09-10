function addQuestion(){
    document.getElementById("submitType").value = "addQuestion";
    document.getElementById("qaForm").submit();
}

function viewQuestion(){
    document.getElementById("submitType").value = "viewQuestion";
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
