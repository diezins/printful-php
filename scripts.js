//$('input#next_button').on('click', GetQuestion());
$(document).ready(GetQuestion());

function GetQuestion(){
    var x = parseInt(document.getElementById('questionNum').value);
    var newID = x + 1;
    $('#questionNum').val(newID);
    
    var selectedID = 1;
    var questionID = 2;
    
    $.post({
        url: 'save_answer.php',
        type: 'POST', 
        data: {answerID: selectedID,questionID: questionID},
        success: function(data){}
    });

    // returns and sets new question and possible answers
    $.post({
        url: 'question.php',
        type: 'POST',
        data: {questionNum:x},
        success: function(data){
            if (!$.trim(data)){
                alert("error from php response"); // next is empty
            } 
            else {
                var Data = $.parseJSON(data);
                if (String(Data.finish) === "true")
                {
                    window.location = "last-view";
                } 
                else
                {
                    $('#options').html(Data.author);
                    $('#title').html(Data.title);
                    $('#question').html(Data.text);
                    // alert(1);
                    if (String(Data.noMore) === "true")
                    {   
                        $('#next_button').val("Finišs"); 
                        document.getElementById('next_button').setAttribute("onClick", "Finish()");
                    }

                }
            }
        },
        error: function(request, statuss, error)
        {
            alert("error in global.js");
        }
      });
}

function Finish(){
    location.href = 'last-view.php';
}

