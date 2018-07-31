function removeButton(){
    document.getElementById("button1").remove();
}

function changeQuestion(title, question){
    document.getElementById("title").innerHTML = title;
    document.getElementById("question").innerHTML = question;
}

function changeAnswers(answerArray){
    var list = document.querySelectorAll(".option"); // returns static NodeList  
    for (var i = 0; i < list.length; i++) {
        list[i].remove(); // removes answer options
    }
    
    for (var i = 0; i < answerArray.length; i++)
    {
        document.createElement("button",[class{"option"}]); // creates the new ones 
    }
}

