//$('input#next_button').on('click', GetQuestion());
$(document).ready(GetQuestion());

function GetQuestion(){
    var x = parseInt(document.getElementById('questionNum').value);
    var newID = x + 1;
    $('#questionNum').val(newID);
    
    // returns formated answer options for question ID in #questionID
    $.post({
        url: 'answers.php',
        type: 'POST',
        data: {questionNum:x},
        success: function(data){
            if (!$.trim(data)){
                alert("error from php response"); // next is empty
            } 
            else {
                // parse salūzt šeit 
                alert(1);
                var Data = $.parseJSON(data);
                alert(Data.if);
                if (String(Data.finish) === "true")
                {
                    window.location = "3rdView";
                } 
                else
                {
                    $('#options').html(Data.author);
                    $('#title').html(Data.title);
                    $('#question').html(Data.text);
                    alert(1);
                    if (String(Data.noMore) === "true")
                    {   
                        $('#next_button').val("Finišs"); 
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